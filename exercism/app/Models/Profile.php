<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Profile extends Model
{
    use HasApiTokens, HasFactory,  Notifiable, HasUuids;
    protected $table = 'profiles';

    public $timestamps = true;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'username',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'id' => 'string',
        'username' => 'string',
        'user_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
