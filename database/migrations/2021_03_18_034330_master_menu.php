<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->enum('type', ['static', 'dynamic'])->default('static');
            $table->text('comments')->nullable();
            $table->enum('status', [1, 0])->default(1);
            $table->integer('created_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('menu');
    }
}
