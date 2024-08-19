<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create([
            'name' => 'mona saleh',
            'email' => 'mona18@gmail.com',
            'password' => Hash::make('1122'),
            'image' => 'Admin.jpg' ,
            'is_admin' => true 
        ]);
        
    }
}
