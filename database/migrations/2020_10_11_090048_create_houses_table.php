<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            TBL_HOUSES,
            function(Blueprint $table)
            {
                $table->id();
                $table->text('name')->unique();
                $table->integer('price')->index();
                $table->smallInteger('bedrooms')->index();
                $table->smallInteger('bathrooms')->index();
                $table->smallInteger('storeys')->index();
                $table->smallInteger('garages')->index();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TBL_HOUSES);
    }
}
