<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Gym extends Model
{
    use HasUuids;

    public $timestamps = true;
    protected $table = 'gyms';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'address_id',
        'created_at',
        'updated_at'
        
    ];
    
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'image' => 'string',
        'description' => 'string',
        'address_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'

    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

}
