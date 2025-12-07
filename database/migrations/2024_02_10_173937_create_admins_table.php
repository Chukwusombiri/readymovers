<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            if (Fortify::confirmsTwoFactorAuthentication()) {
                $table->timestamp('two_factor_confirmed_at')->nullable();
            }
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('admin_role',['super_admin','operation_manager','moderator','content_manager','support_assistance']);
            $table->string('address',225)->nullable();
            $table->string('nationality')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('tax_numer')->nullable();
            $table->string('cv_path')->nullable();
            $table->text('bio')->nullable();
            $table->text('spoken_languages')->nullable();
            $table->boolean('isOnline')->default(0);
            $table->boolean('isSuspended')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('admins');
    }
};
