<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'nombreUsuario',
        'email',
        'contrasena',
        'email_verified_at',
        'verification_token',
        'reset_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'contrasena',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * Get the empleado associated with the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleado(): HasOne
    {
        return $this->hasOne(Empleado::class);
    }

    /**
     * Get the cliente associated with the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
