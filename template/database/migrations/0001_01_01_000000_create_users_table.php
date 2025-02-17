<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->string('full_name', 100)->default('');
            $table->string('name', 20);
            $table->string('bio', 500);
            $table->string('email', 50)->unique();
            $table->string('password', 72);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('phone_number', 72)->nullable()->default(null);
            $table->string('photo', 50)->nullable()->default(null);
            $table->integer('credit')->default(20);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
