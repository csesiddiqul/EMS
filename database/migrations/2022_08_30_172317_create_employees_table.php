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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('id_card ')->unique();;
            $table->string('name');
            $table->date('birthday');
            $table->string('gender');
            $table->string('mobile');
            $table->string('nid');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->string('nationality');
            $table->string('religion');
            $table->string('img');
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
        Schema::dropIfExists('employees');
    }
};
