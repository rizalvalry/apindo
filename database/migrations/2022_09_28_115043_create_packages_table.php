<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->float('price', 12, 2)->default(0);
            $table->integer('expiry_time')->nullable();
            $table->string('expiry_time_type')->nullable();
            $table->boolean('is_image')->default(false);
            $table->boolean('is_video')->default(false);
            $table->boolean('is_amenities')->default(false);
            $table->boolean('is_product')->default(false);
            $table->boolean('is_business_hour')->default(false);
            $table->string('no_of_listing')->nullable();
            $table->integer('no_of_img_per_listing')->nullable();
            $table->integer('no_of_amenities_per_listing')->nullable();
            $table->integer('no_of_product')->nullable();
            $table->integer('no_of_img_per_product')->nullable();
            $table->boolean('seo')->default(1);
            $table->boolean('status')->default(1);
            $table->string('image')->default(null);
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
        Schema::dropIfExists('packages');
    }
}
