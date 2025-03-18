<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('comment_id');
            $table->uuid('user_id'); // Karena user_id panjangnya 36 char
            $table->timestamps();

            
            // Foreign Key Constraints
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Mencegah user like komentar lebih dari sekali
            $table->unique(['comment_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
};
