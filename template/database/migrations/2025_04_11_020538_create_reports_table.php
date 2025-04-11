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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user');
            $table->uuid('id_reported_user');
            $table->uuid('id_content')->nullable();
            $table->uuid('id_comment')->nullable();
            $table->string('reason', 30);
            $table->string('detail', 200);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_reported_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_content')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('id_comment')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
