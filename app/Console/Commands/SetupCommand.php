<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup aplikasi Laravel setelah composer install';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Memulai setup aplikasi Laravel...');

        // 1. Copy .env jika belum ada
        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('✅ File .env berhasil dibuat dari .env.example');
        } else {
            $this->warn('⚠️  File .env sudah ada, dilewati.');
        }

        // 2. Generate APP_KEY
        $this->call('key:generate', ['--force' => true]);

        $this->call('migrate');

        // 3. Migrasi database fresh + seed
        $this->call('migrate:fresh', ['--seed' => true]);

        // 4. Buat storage link
        $this->call('storage:link');

        $this->info('🎉 Setup aplikasi Laravel selesai!');
    }
}
