<?php 

// app/Models/UniqueMessage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueMessage extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'sender_id', 'recipient_id', 'message', 'file_path', 'type'];

    public function conversation()
    {
        return $this->belongsTo(UniqueConversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
