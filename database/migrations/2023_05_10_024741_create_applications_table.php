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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->unsignedBigInteger('verify_id')->nullable();
            $table->foreign('verify_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('salesAccount')->nullable(); 
            $table->string('transactionType')->nullable(); 
            $table->string('dealerSalesAccount')->nullable(); 
            $table->string('desiredUnit')->nullable(); 
            $table->string('bip')->nullable(); 
            $table->string('status')->nullable(); 
            $table->string('bracket')->nullable(); 
            $table->longText('notes')->nullable(); 
            $table->longText('recommendation')->nullable(); 
            $table->string('releasedUnit')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
