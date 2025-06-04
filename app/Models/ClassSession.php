<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    protected $fillable = [
        'class_schedule_id', 'date', 'status', 'notes',
    ];

    public function schedule()
    {
        return $this->belongsTo(ClassSchedule::class);
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
