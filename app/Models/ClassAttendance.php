<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassAttendance extends Model
{
    protected $fillable = [
        'class_session_id', 'member_id', 'checked_in_at', 'checked_out_at',
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
