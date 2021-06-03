<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('firstname');
            $table->string('middlename')->default('');
            $table->string('lastname');
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pics')->default('no_pic.jpg');
            $table->string('phone')->default('');
            $table->date('dob')->default(NULL);
            $table->string('god_eye')->default('0');
            $table->string('status')->default('1');
            $table->string('title_id')->default('');
            $table->string('gender')->default('');
            $table->integer('designation_id')->default('');
            $table->string('branch_id')->default('');
            $table->string('user_type')->default('');
            $table->string('created_by')->default('');
            
            $table->string('chng_password_logon')->default('0');
            
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
