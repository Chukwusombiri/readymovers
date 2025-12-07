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
        Schema::create('packing_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_refNo')->unique();
            $table->enum('service_type',['unpacking','packing']);
            $table->string('username');
            $table->string('email');
            $table->string('phone');                        
            $table->string('items'); 
            $table->float('quote_fee')->default(0);   
            $table->string('distance');
            $table->string('duration');              
            $table->timestamp('dateTime');
            $table->string('address');
            $table->string('postCode');                           
            $table->enum('status',['pending','approved','completed'])->default('pending');
            $table->uuid('approvedByAdmin_id')->nullable();
            $table->foreign('approvedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->uuid('updatedByAdmin_id')->nullable();
            $table->foreign('updatedByAdmin_id')->references('id')->on('admins')->nullOnDelete();           
            $table->uuid('completedByAdmin_id')->nullable();
            $table->foreign('completedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_orders');
    }
};
