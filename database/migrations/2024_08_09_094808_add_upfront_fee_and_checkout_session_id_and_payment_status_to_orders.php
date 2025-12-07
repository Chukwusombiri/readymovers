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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('upfront_fee',8,2);
            $table->string('checkout_session_id')->nullable();
            $table->enum('payment_status',['unpaid','paid','refunded'])->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('upfront_fee');
            $table->dropColumn('checkout_session_id');
            $table->dropColumn('payment_status');
        });
    }
};
