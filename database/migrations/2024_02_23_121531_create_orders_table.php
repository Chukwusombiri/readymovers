<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_refNo')->unique();
            $table->string('username');
            $table->string('email');
            $table->string('phone');                        
            $table->string('order_items'); 
            $table->float('quote_fee')->nullable();           
            $table->timestamp('order_dateTime');
            $table->string('order_pickUpAddress');
            $table->string('order_pickUpPostCode');
            $table->string('order_pickUpFloor');
            $table->boolean('order_pickUpCanUseElevator');
            $table->boolean('order_pickUpNeedExtraMan');
            $table->timestamp('order_expectedPickUpDateTime')->nullable();
            $table->timestamp('order_pickUpDateTime')->nullable();
            $table->string('order_deliveryAddress');        
            $table->string('order_dropOffPostCode');
            $table->string('order_dropOffFloor');
            $table->boolean('order_dropOffCanUseElevator');
            $table->boolean('order_dropOffNeedExtraMan');
            $table->timestamp('order_expectedDeliveryDateTime')->nullable();
            $table->timestamp('order_deliveryDateTime')->nullable();     
            $table->enum('status',['pending','approved','dispatched','delivered']);
            $table->uuid('approvedByAdmin_id')->nullable();
            $table->foreign('approvedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->uuid('updatedByAdmin_id')->nullable();
            $table->foreign('updatedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->uuid('dispatchedByAdmin_id')->nullable();
            $table->foreign('dispatchedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->timestamp('dispatched_at')->nullable();
            $table->uuid('deliveredByAdmin_id')->nullable();
            $table->foreign('deliveredByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
