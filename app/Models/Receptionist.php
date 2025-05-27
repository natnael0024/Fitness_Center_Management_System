<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    protected $fillable = [
        'user_id', 'branch_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->hasOne(Branch::class);
    }
}
