<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'student_name',
        'student_phone',
        'guardian_phone',
        'batch_name',
        'campus_name',
        'status',
        'notes',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}