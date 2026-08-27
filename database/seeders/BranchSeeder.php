<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::firstOrCreate(
            ['code' => 'BR-DHK-01'],
            [
                'name' => 'Dhaka Main Branch (Dhanmondi)',
                'address' => 'Road 27, Dhanmondi, Dhaka',
                'phone' => '01711000001',
                'email' => 'dhaka@coachsync.app',
                'is_active' => true,
            ]
        );

        Branch::firstOrCreate(
            ['code' => 'BR-CTG-01'],
            [
                'name' => 'Chittagong Central Branch (GEC)',
                'address' => 'GEC Circle, Chittagong',
                'phone' => '01811000002',
                'email' => 'ctg@coachsync.app',
                'is_active' => true,
            ]
        );
    }
}
