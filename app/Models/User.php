<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính được phép gán dữ liệu hàng loạt (Mass Assignment)
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    /**
     * Các thuộc tính ẩn khi chuyển model thành mảng hoặc JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ép kiểu dữ liệu tự động (Casting)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Quan hệ Eloquent: 1 User thuộc về 1 Role (Khóa ngoại role_id)
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Hàm tiện ích kiểm tra tài khoản có phải Admin không (role_id = 1)
     */
    public function isAdmin(): bool
    {
        return (int) $this->role_id === 1;
    }
}
