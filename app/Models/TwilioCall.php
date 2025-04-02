<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwilioCall extends Model
{
    use HasFactory;
    protected $fillable = ['sid', 'type', 'from' ,'to', 'duration', 'recording_url', 'direction', 'user_id', 'created_at'];
}
