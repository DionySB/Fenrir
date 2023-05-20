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

class Adress extends Model
{
    use HasUuids;

    public $timestamps = true;
    protected $table = 'adresses';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'address',
        'city',
        'postalcode',
        'province',
        'user_id',
        'created_at',
        'updated_at'
        
    ];
    
    protected $casts = [
        'id' => 'string',
        'address' => 'string',
        'city' => 'string',
        'postalcode' => 'string',
        'province' => 'string',
        'user_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'

    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
