<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->string('type');
            $table->string('device_platform');
            $table->string('browser_family');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('ip')->nullable();
            $table->timestamp('time_redirect')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links_statistics');
    }
}
