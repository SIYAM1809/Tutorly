<?php

namespace App\Models;

use App\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory, BelongsToBranch;

    protected $fillable = [
        'branch_id',
        'batch_id',
        'student_id',
        'marked_by_id',
        'attendance_date',
        'status',
        'notes',
    ];

    protected $casts = [
        // Keep attendance_date as string for SQLite compatibility;
        // use whereDate() in queries instead of casting to Carbon
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function markedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marked_by_id');
    }
}
