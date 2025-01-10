<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // role_idを追加
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザーの予約リレーション
    public function reservations()
    {
        return $this->belongsToMany(Shop::class, 'reservations')->withPivot('id', 'date', 'time', 'user_num');
    }

    // ユーザーのお気に入りリレーション
    public function likes()
    {
        return $this->belongsToMany(Shop::class, 'likes');
    }

    // 店舗代表者が管理する店舗リレーション
    public function shops()
    {
        return $this->hasMany(Shop::class, 'owner_id'); 
    }

    // ユーザーの役割リレーション
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }

    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

}
