<?php

namespace CompassHB\Www\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Cloud;

class DatabaseBackup extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database to S3';

    /**
     * Execute the console command.
     *
     * @param Cloud $cloud
     * @return mixed
     */
    public function handle(Cloud $cloud)
    {
        $filename = storage_path('/database.sql.gz.gpg');

        // Dump, compress, and encrypt database.
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s --all-databases | gzip | gpg --yes --batch --passphrase %s --symmetric -o %s',
            escapeshellarg(env('DB_USERNAME')),
            escapeshellarg(env('DB_PASSWORD')),
            escapeshellarg(env('DB_HOST')),
            escapeshellarg(env('DB_PASSWORD')),
            escapeshellarg($filename)
        );
        exec($command);

        $cloud->put('database/database_'.time().'.sql.gz.gpg', $filename);
        exec('rm '.$filename);
    }
}
