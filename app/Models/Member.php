<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'membership_plan_id', 'branch_id', 'join_date', 'initial_weight','height','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function enrollments()
    {
        return $this->hasMany(ClassEnrollment::class);
    }

    public function attendance()
    {
        return $this->hasMany(ClassAttendance::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }
}
