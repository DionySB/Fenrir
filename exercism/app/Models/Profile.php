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
        'gender',
        'profile_image',
        'birth_date',
        'fitness_goals',
        'fitness_level',
        'health_info',
        'exercise_history',
        'time_preferences',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'id' => 'string',
        'username' => 'string',
        'gender' => 'string',
        'profile_image' => 'string',
        'birth_date' => 'date',
        'fitness_goals' => 'string',
        'fitness_level' => 'string',
        'health_info' => 'string',
        'exercise_history' => 'string',
        'time_preferences' => 'string',
        'user_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
