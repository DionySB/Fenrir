<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Address;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory,  Notifiable, HasUuids, MustVerifyEmail;

    public $timestamps = true;
    protected $table = 'users';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'address_id',
        'profile_id',
        'created_at',
        'updated_at'
    ];
    
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'email_verified_at' => 'datetime',
        'address_id' => 'string',
        'profile_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];

    /**
     * void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
