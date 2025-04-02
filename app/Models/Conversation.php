<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_1_id', 'user_2_id'];

    public function messages()
    {
        return $this->hasMany(UniqueMessage::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
