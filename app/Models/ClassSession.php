<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    protected $fillable = [
        'class_id', 'date', 'start_time', 'end_time',
        'is_cancelled', 'notes',
    ];

    public function class()
    {
        return $this->belongsTo(GymClass::class, 'class_id');
    }

    public function enrollments()
    {
        return $this->hasMany(ClassEnrollment::class);
    }

    public function attendance()
    {
        return $this->hasMany(ClassAttendance::class);
    }
}
