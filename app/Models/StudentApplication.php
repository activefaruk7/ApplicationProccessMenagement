<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentApplication extends Model
{ use HasFactory;
    protected $fillable=[
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'description',
        'summary',
        'date',
        'teacher_id',
        'management_ids',
        'status',
        'comment',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function app_role () {
        return $this->hasOne(AppRole::class, 'student_application_id', 'id');
    }

}
