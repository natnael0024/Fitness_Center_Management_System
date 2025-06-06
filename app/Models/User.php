<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'email',
        'phone',
        'password',
        'address',
        'city',
        'country',
        'postal',
        'about',
        'avatar',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User {$this->name} has been {$eventName}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('user')
            ->logOnly(['name', 'email'])  
            ->logOnlyDirty()              // Log only if data actually changed
            ->dontSubmitEmptyLogs();      // Avoid logging if nothing was updated
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset($this->avatar) : asset('img/default-avatar.png');
    }

    public function trainer() { return $this->hasOne(Trainer::class); }
    public function branchManager() { return $this->hasOne(BranchManager::class); }
    public function receptionist() { return $this->hasOne(Receptionist::class); }
    

}
