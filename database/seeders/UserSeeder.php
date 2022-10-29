<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin'=>'1',
            
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'admin',
            'name' => 'admin',
            'email' => 'company@company.com',
            'is_admin'=> '0',
            
            'password' => Hash::make('12345678'),
        ]);
    }
}
