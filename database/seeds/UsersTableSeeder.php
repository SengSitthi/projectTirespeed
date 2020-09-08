<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Tirespeed',
            'email' => 'tirespeed@gmail.com',
            'password' => Hash::make('Tirespeed2019'),
            'remember_token' => Str::random(10),
            'empid' => 'EMP001',
        ]);
    }
}
