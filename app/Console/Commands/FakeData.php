<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成測試用的使用者、Meeting、便當訂購資料';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->environment() !== 'local') {
            $this->error('This command can only be run in the local environment.');
            return 1;
        }

        $this->info('Starting seeding in local environment...');

        $seeders = [
            'DatabaseSeeder',
            'MeetingSeeder',
            'BandonSeeder',
        ];

        foreach ($seeders as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder, '--force' => true]);
            $this->info("$seeder done.");
        }

        $this->info('All seeders executed successfully!');
        return 0;
    }
}
