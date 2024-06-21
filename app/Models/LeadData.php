<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadData extends Model
{
    use HasFactory;
    protected $table = 'lead_data';

    protected $fillable = ['status_id','name', 'email', 'phone', 'message', 'view'];

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'status_id');
    }
}
