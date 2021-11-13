<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role () {
        return $this->belongsTo(Role::class);
    }
    public function convarsetions () {
        return $this->hasMany(Convarsetion::class);
    }

    public function isTeacher() {
        return $this->role_id == 2;
    }
    public function isStudent() {
        return $this->role_id == 1;
    }

    public function isDin() {
        return $this->role_id == 3;
    }
    public function isHead() {
        return $this->role_id == 4;
    }
    public function isOther3() {
        return $this->role_id == 5;
    }
    public function isOther4() {
        return $this->role_id == 6;
    }
    public function isOther5() {
        return $this->role_id == 7;
    }

    public function app_role() {
        return $this->hasOne(AppRole::class, 'user_id', 'id');
    }


}
