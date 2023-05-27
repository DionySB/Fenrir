<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->required();
            $table->enum('gender', ['Feminino', 'Masculino', 'Prefiro não dizer', 'Outro'])->default('Prefiro não dizer');
            $table->string('profile_image')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('fitness_goals')->nullable();
            $table->enum('fitness_level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->string('health_info')->nullable();
            $table->string('exercise_history')->nullable();
            $table->string('time_preferences')->nullable();
            $table->uuid('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
