<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department',
        'position',
        // 'is_super_admin',
    ];

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if this admin is a super admin
    public function isSuperAdmin()
    {
        return $this->is_super_admin === 1;
    }
}
