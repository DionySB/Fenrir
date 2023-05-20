<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Address extends Model
{
    use HasUuids;

    public $timestamps = true;
    protected $table = 'addresses';
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

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
