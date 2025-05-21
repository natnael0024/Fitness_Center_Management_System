<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'title', 'description', 'trainer_id', 'branch_id',
        'capacity', 'is_premium', 'price',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function sessions()
    {
        return $this->hasMany(ClassSession::class);
    }
}
