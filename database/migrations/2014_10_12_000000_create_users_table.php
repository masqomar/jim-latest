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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->string('country_code')->default('+62');
            $table->string('member_id')->unique();
            $table->string('mobile')->default(0);
            $table->string('cover')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('verified')->nullable();
            $table->string('type')->default('user');
            $table->date('dob')->nullable();
            $table->date('date')->nullable();
            $table->text('fcm_token')->nullable();
            $table->text('others')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('extra_field')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
