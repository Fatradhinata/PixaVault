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
            $table->string('google_id');
            $table->string('google_token');
            $table->string('google_refresh_token');
            $table->string('full_name', 100)->default('');
            $table->string('name', 20);
            $table->string('email', 50)->unique();
            $table->string('password', 72);
            $table->enum('role', ['admin', 'user']);
            $table->string('phone_number', 72)->nullable()->default(null);
            $table->string('photo', 50)->nullable()->default(null);
            $table->integer('free_limit_upload')->default(20);
            $table->integer('free_limit_download')->default(10);
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
