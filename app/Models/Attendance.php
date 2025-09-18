<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade_id',
        'date',
        'reason',
        'status',
    ];

    public function student () {
        return $this->belongsTo(Student::class);
    }

    public function grade( ) {
        return $this->belongsTo(Grade::class);
    }
}
