<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'aupair', 'family'])->default('aupair');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('au_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->date('birth_date');
            $table->string('nationality')->nullable();
            $table->json('languages')->nullable();
            $table->text('bio')->nullable();
            $table->enum('status', ['pending', 'screening', 'approved', 'placed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('host_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('family_name');
            $table->string('city');
            $table->string('country');
            $table->integer('children_count')->default(1);
            $table->text('expectations')->nullable();
            $table->timestamps();
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('current_step')->default(1);
            $table->enum('status', ['in_progress', 'submitted', 'reviewing', 'rejected', 'completed'])->default('in_progress');
            $table->json('step_data')->nullable();
            $table->timestamps();
        });

        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('au_pair_id')->constrained('au_pairs');
            $table->foreignId('host_family_id')->constrained('host_families');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['pending', 'active', 'finished', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('host_families');
        Schema::dropIfExists('au_pairs');
        Schema::dropIfExists('users');
    }
};
