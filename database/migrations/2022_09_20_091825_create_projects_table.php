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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->integer('project_code');
            $table->integer('assign_to');
            $table->string('trial_period')->nullable();;
            $table->date('start_data')->nullable();;
            $table->date('complete_data')->nullable();;
            $table->date('hand_over_data')->nullable();;
            $table->tinyInteger('status')->comment('1=active, 2=on-hold, 3= complete');
            $table->string('srs');
            $table->longText('technology_used')->nullable();;
            $table->integer('maintenance_id')->nullable();;
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
        Schema::dropIfExists('projects');
    }
};
