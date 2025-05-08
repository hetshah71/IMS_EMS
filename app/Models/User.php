<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Role relationships
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    // Check if user has role
    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
    // Check if user has permission
    public function hasPermission($permission): bool
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }
    // Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin' || $this->hasRole('admin');
    }
    // Check if user is intern
    public function isIntern()
    {
        return $this->role === 'intern' || $this->hasRole('intern');
    }

    // Admin relationship
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    // Intern relationship
    public function intern()
    {
        return $this->hasOne(Intern::class);
    }
    public function isSuperAdmin()
    {
        return $this->admin && $this->admin->isSuperAdmin();
    }
    // Comments relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Tasks created by user admin
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // Sent messages
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Received messages
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
}