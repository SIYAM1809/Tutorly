<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $dhakaBranch = Branch::where('code', 'BR-DHK-01')->first();

        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@coachsync.app'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'user_type' => 'super_admin',
                'phone' => '01700000001',
                'preferred_language' => 'en',
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 2. Branch Admin
        $branchAdmin = User::firstOrCreate(
            ['email' => 'admin.dhaka@coachsync.app'],
            [
                'branch_id' => $dhakaBranch?->id,
                'name' => 'Dhaka Branch Manager',
                'password' => Hash::make('password'),
                'user_type' => 'branch_admin',
                'phone' => '01700000002',
                'preferred_language' => 'en',
            ]
        );
        $branchAdmin->assignRole('branch_admin');

        // 3. Teacher
        $teacher = User::firstOrCreate(
            ['email' => 'rahim.teacher@coachsync.app'],
            [
                'branch_id' => $dhakaBranch?->id,
                'name' => 'Professor Rahim Uddin',
                'password' => Hash::make('password'),
                'user_type' => 'teacher',
                'phone' => '01700000003',
                'preferred_language' => 'en',
            ]
        );
        $teacher->assignRole('teacher');

        // 4. Sample Students
        $studentNames = [
            'Aarif Hasan',
            'Nusrat Jahan',
            'Tanvir Rahman',
            'Sadiya Islam',
            'Fahim Ahmed'
        ];

        foreach ($studentNames as $idx => $name) {
            $st = User::firstOrCreate(
                ['email' => 'student' . ($idx + 1) . '@coachsync.app'],
                [
                    'branch_id' => $dhakaBranch?->id,
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'user_type' => 'student',
                    'phone' => '017111000' . ($idx + 1),
                    'guardian_phone' => '018111000' . ($idx + 1),
                    'preferred_language' => 'en',
                ]
            );
            $st->assignRole('student');
        }
    }
}
