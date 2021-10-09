<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'description',
        'summary',
        'date',
        'status',
        'comment',
    ];
    use HasFactory;

    public function user(){
        return $this->BelongsTo(User::class);
    }
    
}
