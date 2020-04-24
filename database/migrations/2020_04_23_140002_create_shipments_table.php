<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('shipments');
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_location_id')->unsigned();
            $table->integer('to_location_id')->unsigned();
            $table->float('cost');
            $table->string('name');
            $table->boolean('is_received')->default(0);
            $table->boolean('is_shipped')->default(0);

            $table->foreign('from_location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');

            $table->foreign('to_location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
