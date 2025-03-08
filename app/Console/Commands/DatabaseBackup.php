<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a backup of the database and store it in the backups folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $db_host = env('DB_HOST', '127.0.0.1');
        $db_name = env('DB_DATABASE');
        $db_user = env('DB_USERNAME');
        $db_password = env('DB_PASSWORD');

        $file_name = 'backupfromMe'. '.sql';
        $backup_path = storage_path('app/backups/' . $file_name);

        // Ensure the directory exists
        if (!Storage::exists('backups')) {
            Storage::makeDirectory('backups');
        }

        // Dump command
        $command = "mysqldump --user={$db_user} --password={$db_password} --host={$db_host} {$db_name} > {$backup_path}";

        exec($command, $output, $result_code);

        if ($result_code === 0) {
            $this->info("Database backup successful! File saved: {$file_name}");
        } else {
            $this->error("Database backup failed!");
        }
    }
}
