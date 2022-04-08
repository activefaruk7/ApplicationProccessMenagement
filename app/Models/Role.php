<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function generateRole() {
        $att = [
            ['name' => 'student'],
            ['name' => 'teacher'],
            ['name' => 'din'],
            ['name' => 'head'],
            ['name' => 'admin'],
            ['name' => 'acad'],
            ['name' => 'superAdmin'],
            ['name' => 'register'],
            ['name' => 'viceChancellor'],
        ];

        foreach ($att as $key => $value) {
            $role = new Role();
            $role->name = $value['name'];
            $role->save();
        }
    }
}