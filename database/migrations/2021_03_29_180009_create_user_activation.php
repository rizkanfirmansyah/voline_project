<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_activation', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['activation', 'forgotpassword', 'blocked', 'message', 'unknown']);
            $table->string('email');
            $table->string('token');
            $table->string('status')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_activation');
    }
}
