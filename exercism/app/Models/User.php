<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory,  Notifiable, HasUuids;

    public $timestamps = true;
    protected $table = 'users';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];
    
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}