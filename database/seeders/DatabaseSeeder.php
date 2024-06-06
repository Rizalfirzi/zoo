<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\District;
use App\Models\Master\MasterJenisPemilihan;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeederTableSeeder::class);
        $this->call(PermissionManagementDatabaseSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(RegencySeeder::class);
        // $this->call(DistrictSeeder::class);
        // $this->call(VillageSeeder::class);
        $this->call(SettingSeederTableSeeder::class);
        
    }
}
