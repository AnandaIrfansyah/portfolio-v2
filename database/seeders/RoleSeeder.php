<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $authorRole = Role::firstOrCreate(['name' => 'author']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create author user
        $author = User::firstOrCreate(
            ['email' => 'anndairfnsyh@gmail.com'],
            [
                'name' => 'Ananda Irfansyah',
                'password' => Hash::make('password'),
            ]
        );
        $author->assignRole($authorRole);

        // Create normal user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($userRole);
    }
}
