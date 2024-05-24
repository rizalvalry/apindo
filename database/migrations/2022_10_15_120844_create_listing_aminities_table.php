<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingAminitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_aminities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->index()->nullable();
            $table->foreignId('purchase_package_id')->index()->nullable();
            $table->foreignId('amenity_id')->index()->nullable();
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
        Schema::dropIfExists('listing_aminities');
    }
}
