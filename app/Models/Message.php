<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

   protected $fillable = ['sid', 'from', 'type' ,'to', 'body', 'direction', 'created_at'];
}
