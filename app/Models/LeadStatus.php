<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $table = 'lead_status';

    protected $fillable = ['type', 'priority', 'default', 'label_color', 'mobile'];

    public function leadData()
    {
        return $this->hasMany(LeadData::class, 'status_id');
    }
}
