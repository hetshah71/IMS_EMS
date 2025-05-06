<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'content',
    ];

    // Task relationship
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // User who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
