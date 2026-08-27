<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('branch.{branchId}', function ($user, $branchId) {
    return $user->user_type === 'super_admin' || (int) $user->branch_id === (int) $branchId;
});

Broadcast::channel('batch.{batchId}', function ($user, $batchId) {
    return true;
});
