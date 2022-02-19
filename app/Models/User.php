<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN = 5;
    const STUDENT = 1;
    const TEACHER = 2;
    const HEAD = 3;
    const DEAN = 4;
    const ACAD = 6;
    const MANAGEMENT = [3,4,5];
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

    public function student_applications () {
        return $this->hasMany(StudentApplication::class, 'user_id', 'id');
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

    public function isAdmin() {
        return $this->role_id == 5;
    }

    public function isManagenent() {
        if ($this->role_id == 3 || $this->role_id == 4 || $this->role_id == 6) {
            return true;
        }
    }

    public function app_role() {
        return $this->hasOne(AppRole::class, 'user_id', 'id');
    }


    public static function generateNewManagemnet() {
        $users = [
            [
                'name' => "Head",
                'email' => "head@mail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'role_id' => '4',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Dean",
                'email' => "dean@mail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'role_id' => '3',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Admin",
                'email' => "admin@mail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'role_id' => '5',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Acad",
                'email' => "acad@mail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'role_id' => '6',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "superAdmin",
                'email' => "superadmin@mail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'role_id' => '7',
                'remember_token' => Str::random(10),
            ],

        ];

        foreach($users as $user) {
            self::create($user);
        }
    }


}
