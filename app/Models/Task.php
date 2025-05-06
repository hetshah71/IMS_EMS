<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Creator relationship
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Interns assigned to this task
    public function interns()
    {
        return $this->belongsToMany(Intern::class, 'task_intern');
    }

    // Comments on this task
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
