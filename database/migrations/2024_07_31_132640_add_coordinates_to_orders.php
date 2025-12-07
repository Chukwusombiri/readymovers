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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_pickUpCoordinates')->after('order_pickUpAddress');
            $table->string('order_dropOffCoordinates')->after('order_deliveryAddress');;
            $table->string('distance')->after('quote_fee');
            $table->string('duration')->after('distance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_pickUpCoordinates');
            $table->dropColumn('order_dropOffCoordinates');
            $table->dropColumn('distance');
            $table->dropColumn('duration');
        });
    }
};
