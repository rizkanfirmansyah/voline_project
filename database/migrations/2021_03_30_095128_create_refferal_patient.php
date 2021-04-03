<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefferalPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refferal_patient', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->integer('user_id');
            $table->dateTime('date');
            $table->integer('hospital_id');
            $table->char('status');
            $table->char('umur');
            $table->char('no_reg');
            $table->char('no_pattient')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refferal_patient');
    }
}
