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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo_url');
            $table->text('description')->nullable();
            $table->boolean('isCountable')->default(1);
            $table->uuid('createdByAdmin_id')->nullable();
            $table->foreign('createdByAdmin_id')->references('id')->on('admins')->nullOnDelete();
            $table->uuid('updatedByAdmin_id')->nullable();
            $table->foreign('updatedByAdmin_id')->references('id')->on('admins')->nullOnDelete();
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
        Schema::dropIfExists('items');
    }
};
