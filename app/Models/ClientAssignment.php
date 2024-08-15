<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAssignment extends Model
{
    use HasFactory;

    // Add phone_number to the fillable array
    protected $fillable = ['phone_number', 'user_id'];
}
