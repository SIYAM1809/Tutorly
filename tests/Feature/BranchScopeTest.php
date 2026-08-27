<?php

use App\Models\Branch;
use App\Models\User;
use App\Models\Batch;

test('models automatically restrict queries to logged in user branch', function () {
    $branchA = Branch::create(['name' => 'Branch A', 'code' => 'BR-A']);
    $branchB = Branch::create(['name' => 'Branch B', 'code' => 'BR-B']);

    $userA = User::create([
        'branch_id' => $branchA->id,
        'name' => 'User Branch A',
        'email' => 'usera@test.com',
        'password' => bcrypt('password'),
        'user_type' => 'branch_admin',
    ]);

    $batchA = Batch::create(['branch_id' => $branchA->id, 'name' => 'Batch A', 'subject' => 'Math', 'monthly_fee' => 1000]);
    $batchB = Batch::create(['branch_id' => $branchB->id, 'name' => 'Batch B', 'subject' => 'English', 'monthly_fee' => 1000]);

    $this->actingAs($userA);

    $batches = Batch::all();
    expect($batches->pluck('id'))->toContain($batchA->id);
    expect($batches->pluck('id'))->not->toContain($batchB->id);
});
