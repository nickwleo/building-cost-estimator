<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('blurb');
            $table->double('price_per', 10, 2);
            $table->integer('node_id');
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
        //
        Schema::drop('nodes');
    }
}
