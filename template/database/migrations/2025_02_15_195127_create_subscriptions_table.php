<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key UUID
            $table->char('user_id', 36); // Sesuaikan dengan tipe UUID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign Key
        
            $table->string('order_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('payment_type');
            $table->string('status')->default('pending');
            $table->date('date_limit')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
