<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
        'street',
        'city',
        'postal_code',
        'province',
        'user_id',
        'created_at',
        'updated_at'
        
    ];
    
    protected $casts = [
        'id' => 'string',
        'street' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'province' => 'string',
        'user_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
