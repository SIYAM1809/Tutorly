<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Fee;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BatchSeeder extends Seeder
{
    public function run(): void
    {
        $dhakaBranch = Branch::where('code', 'BR-DHK-01')->first();
        $teacher = User::where('user_type', 'teacher')->first();
        $students = User::where('user_type', 'student')->get();

        if (!$dhakaBranch) return;

        $batch1 = Batch::firstOrCreate(
            ['name' => 'HSC Higher Math 2026-A'],
            [
                'branch_id' => $dhakaBranch->id,
                'teacher_id' => $teacher?->id,
                'subject' => 'Higher Mathematics',
                'monthly_fee' => 3500.00,
                'capacity' => 45,
                'schedule_days' => 'Sun,Tue,Thu',
                'schedule_time' => '10:00 AM - 11:30 AM',
                'is_active' => true,
            ]
        );

        $batch2 = Batch::firstOrCreate(
            ['name' => 'HSC Physics Advanced 2026'],
            [
                'branch_id' => $dhakaBranch->id,
                'teacher_id' => $teacher?->id,
                'subject' => 'Physics',
                'monthly_fee' => 3200.00,
                'capacity' => 40,
                'schedule_days' => 'Sat,Mon,Wed',
                'schedule_time' => '04:00 PM - 05:30 PM',
                'is_active' => true,
            ]
        );

        // Enroll sample students & create demo fee records
        foreach ($students as $idx => $student) {
            Enrollment::firstOrCreate([
                'student_id' => $student->id,
                'batch_id' => $batch1->id,
            ], [
                'roll_number' => 'MATH-2026-' . sprintf('%03d', $idx + 1),
                'enrolled_at' => Carbon::now()->subMonths(2),
                'status' => 'active',
            ]);

            Fee::firstOrCreate([
                'student_id' => $student->id,
                'batch_id' => $batch1->id,
                'title' => 'Monthly Fee - August 2026',
            ], [
                'branch_id' => $dhakaBranch->id,
                'amount' => 3500.00,
                'due_date' => Carbon::now()->addDays(5),
                'status' => $idx === 0 ? 'paid' : 'unpaid',
                'paid_amount' => $idx === 0 ? 3500.00 : 0.00,
            ]);
        }
    }
}
