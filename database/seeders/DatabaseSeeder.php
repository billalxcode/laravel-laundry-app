<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::findOrCreate('owner');
        Role::findOrCreate('customer');

        $owner = User::factory()->create([
            'name' => 'Owner',
            'email' => 'admin@admin.com',
        ]);
        $owner->assignRole('owner');
        
        User::factory(10)->create();
    }
}
