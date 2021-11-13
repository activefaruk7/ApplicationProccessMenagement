<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convarsetion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function studentMessages() {
        return $this->masseges->user_id;
    }
}
