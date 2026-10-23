<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    // Quan hệ 1 Role có nhiều User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}