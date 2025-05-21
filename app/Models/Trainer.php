<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id', 'branch_id', 'hire_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->hasMany(GymClass::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

}
