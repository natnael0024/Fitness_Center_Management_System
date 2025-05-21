<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'address', 'phone','manager_id'
    ];

    public function classes()
    {
        return $this->hasMany(GymClass::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class,'id','manager_id');
    }
}
