<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'role_id',
        'avatar',
        'CIN',
        'Adresse',
        'VersoIdentite',
        'RectoIdentite',
    ];


    public function favoriteProperties() {
        return $this->belongsToMany(Property::class, 'favorite_properties', 'user_id', 'property_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function agentRequest()
{
    return $this->hasOne(AgentRequest::class);
}



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
    ];
}
