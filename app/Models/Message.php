<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'content',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    // Sender relationship
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Recipient relationship
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
