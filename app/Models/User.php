<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get activity plans created by the user.
     */
    public function activityPlans()
    {
        return $this->hasMany(ActivityPlan::class);
    }

    /**
     * Get contents created by the user.
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($roleSlug)
    {
        return $this->role && $this->role->slug === $roleSlug;
    }

    /**
     * Check if user is Ketua.
     */
    public function isKetua()
    {
        return $this->hasRole('ketua');
    }

    /**
     * Check if user is Admin Data.
     */
    public function isAdmin()
    {
        return $this->hasRole('admin-data');
    }

    /**
     * Check if user is Anggota.
     */
    public function isAnggota()
    {
        return $this->hasRole('anggota');
    }
}
