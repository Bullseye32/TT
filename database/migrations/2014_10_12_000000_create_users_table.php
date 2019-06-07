<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('user_name')->unique();
            $table->string('profile_image')->nullable();
            $table->string('email')->unique()->nullable();

            $table->string('contact')->nullable();
            $table->string('permanent_add')->nullable();
            $table->string('temporary_add')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('google_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();

            $table->date('join_date')->nullable();
            $table->string('department')->nullable();

            $table->enum('user_type', ['admin','staff','account'])->default('staff');
            $table->enum('status', ['active','inactive'])->default('active');

            $table->text('data')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
