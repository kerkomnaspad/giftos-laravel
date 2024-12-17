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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users');
            $table->integer('item_id')->constrained('items');
            $table->integer ('quantity');
            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
