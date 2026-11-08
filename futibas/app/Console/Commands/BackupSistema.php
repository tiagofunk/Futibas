<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use ZipArchive;

class BackupSistema extends Command
{
    protected $signature = 'sistema:backup';
    protected $description = 'Gera um backup completo da base de dados PostgreSQL (via PHP) e da pasta storage/public';

    public function handle()
    {
        $this->info('Iniciando o backup do sistema...');

        // 1. Cria a pasta de backups se não existir
        $backupPath = storage_path('app/backups');
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $zipFilename = "backup_{$timestamp}.zip";
        $zipFullPath = "{$backupPath}/{$zipFilename}";

        $zip = new ZipArchive;

        if ($zip->open($zipFullPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            // --- 2. BACKUP DA BASE DE DADOS POSTGRESQL (NATIVO EM PHP) ---
            $this->info('Exportando base de dados PostgreSQL...');
            $sqlPath = storage_path("app/backup_db_{$timestamp}.sql");
            
            $sqlContent = "-- Backup PostgreSQL gerado automaticamente pelo Laravel\n";
            $sqlContent .= "-- Data: " . Carbon::now()->toDateTimeString() . "\n\n";

            // Consulta as tabelas do esquema público no PostgreSQL
            $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");
            
            foreach ($tables as $table) {
                $tableName = $table->table_name;

                // Ignora a tabela de migrações padrão do Laravel se quiser, ou mantém. Vamos manter todas.
                $rows = DB::table($tableName)->get();
                
                if ($rows->count() > 0) {
                    $sqlContent .= "-- Dados da tabela: {$tableName}\n";
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        // No Postgres usamos aspas duplas para colunas/tabelas se necessário
                        $columns = implode('", "', array_keys($rowArray));
                        
                        $values = implode(', ', array_map(function ($value) {
                            if (is_null($value)) return 'NULL';
                            // Trata booleanos e strings no PostgreSQL
                            if (is_bool($value)) return $value ? 'TRUE' : 'FALSE';
                            return "'" . str_replace("'", "''", $value) . "'";
                        }, array_values($rowArray)));

                        $sqlContent .= "INSERT INTO \"{$tableName}\" (\"{$columns}\") VALUES ({$values});\n";
                    }
                    $sqlContent .= "\n";
                }
            }

            File::put($sqlPath, $sqlContent);

            if (file_exists($sqlPath)) {
                $zip->addFile($sqlPath, 'database.sql');
            }

            // --- 3. BACKUP DAS IMAGENS (STORAGE/PUBLIC) ---
            $this->info('Compactando imagens e arquivos...');
            $storagePath = storage_path('app/public');
            
            if (File::exists($storagePath)) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($storagePath),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = 'storage/' . substr($filePath, strlen(storage_path('app/public')) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }

            $zip->close();

            // Apaga o ficheiro SQL temporário
            if (file_exists($sqlPath)) {
                unlink($sqlPath);
            }

            $this->info("Backup concluído com sucesso!");
            $this->info("Ficheiro guardado em: {$zipFullPath}");

        } else {
            $this->error('Falha ao criar o arquivo ZIP de backup.');
        }
    }
}