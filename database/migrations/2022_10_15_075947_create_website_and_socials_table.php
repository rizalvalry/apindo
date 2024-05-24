<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteAndSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_and_socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->index()->nullable();
            $table->foreignId('purchase_package_id')->index()->nullable();
            $table->string('social_icon')->nullable();
            $table->string('social_url')->nullable();
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
        Schema::dropIfExists('website_and_socials');
    }
}
