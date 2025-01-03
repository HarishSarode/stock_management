<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['email' => 'dkinfo@mailinator.com'], ['name' => 'Admin', 'email' => 'dkinfo@mailinator.com', 'password' => Hash::make('dkinfo@123')]);
    }
}
