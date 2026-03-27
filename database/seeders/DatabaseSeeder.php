<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->cleanStorage();

        DB::transaction(function () {
            $this->call([
                SkillSeeder::class,
                AdminUserSeeder::class,
                CompanySeeder::class,
                TeamSeeder::class,
                SeekerSeeder::class,
                CompanyInteractionSeeder::class,
                JobSeeder::class,
            ]);
        });
    }

    private function cleanStorage(): void
    {
        $folders = ['logos', 'avatars', 'images', 'covers'];

        foreach ($folders as $folder) {
            Storage::disk('public')->deleteDirectory($folder);
        }

        $this->command->info('✅ Storage folders cleared.');
    }
}
