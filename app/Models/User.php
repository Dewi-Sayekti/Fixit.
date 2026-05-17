<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // If you prefer auto hashing, Laravel 12+ supports hashed cast,
        // but we assume passwords are hashed on create/seeder.
    ];

    // relasi: user punya banyak aduan
    public function aduans(): HasMany
    {
        return $this->hasMany(Aduan::class);
    }

    // relasi: user punya banyak rating
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
