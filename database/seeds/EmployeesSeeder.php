<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add employee data
        Employee::create([
            'empid' => 'EMP001',
            'name' => 'Tirespeed',
            'lastname' => 'Tirespeed',
            'birthday' => '2020-01-05',
            'village' => 'ໂພນ​ທັນ',
            'disid' => '86',
            'proid' => '11',
            'mobile' => '02055102570',
            'email' => 'tirespeed@gmail.com',
        ]);
    }
}
