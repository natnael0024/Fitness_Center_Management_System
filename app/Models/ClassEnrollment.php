<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassEnrollment extends Model
{
    protected $fillable = [
        'class_session_id', 'member_id', 'paid_amount', 'status',
    ];

    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'class_session_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
