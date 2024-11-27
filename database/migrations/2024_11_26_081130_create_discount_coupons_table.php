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
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->nullable();
            $table->text('description');
            $table->integer('max_users')->nullable();
            $table->integer('max_uses_user')->nullable();
            $table->enum('type', ['percent', 'fixed'])->default('fixed');
            $table->double('discount_account', 10, 2);
            $table->double('min_account', 10, 2)->nullable();
            $table->integer('status')->default(1);
            $table->timestamp('starts_at')->nullable(); // Single timestamp column
            $table->timestamp('expires_at')->nullable(); // Single timestamp column
            $table->timestamps(); // Adds created_at and updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
