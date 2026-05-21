<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->enum('discount_type', ['fixed', 'percent']);
        $table->decimal('discount_value', 10, 2);
        $table->date('valid_from')->nullable();
        $table->date('valid_until')->nullable();
        $table->integer('usage_limit')->nullable();
        $table->integer('used_count')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
