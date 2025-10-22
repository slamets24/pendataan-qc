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
        $users = [
            ['name' => 'Admin QC', 'username' => 'admin', 'email' => 'admin@qc.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Staff QC 1', 'username' => 'staff1', 'email' => 'staff1@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Staff QC 2', 'username' => 'staff2', 'email' => 'staff2@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Staff QC 3', 'username' => 'staff3', 'email' => 'staff3@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Staff QC 4', 'username' => 'staff4', 'email' => 'staff4@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Admin Warehouse', 'username' => 'admin_wh', 'email' => 'admin.wh@qc.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Staff Warehouse 1', 'username' => 'staff_wh1', 'email' => 'staff.wh1@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Staff Warehouse 2', 'username' => 'staff_wh2', 'email' => 'staff.wh2@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
            ['name' => 'Supervisor QC', 'username' => 'supervisor', 'email' => 'supervisor@qc.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Staff Input', 'username' => 'staff_input', 'email' => 'staff.input@qc.com', 'password' => Hash::make('password'), 'role' => 'staff'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
