<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $fillable = [
        'name', 'price', 'duration_days',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
