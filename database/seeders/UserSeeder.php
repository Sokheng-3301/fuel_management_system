<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname_kh' => 'វឿន សុខហេង',
            'fullname_en' => 'Voeurn Sokheng',
            'gender' => 'm',
            'username' => 'admin@fms',
            'password' => Hash::make('fms@123'),
            'role' => 'superadmin',
        ]);

    }
}
