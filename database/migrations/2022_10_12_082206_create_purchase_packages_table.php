<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('package_id')->index();
            $table->float('price', 12, 2)->default(0);
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
            $table->boolean('status')->default(0);
            $table->date('purchase_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->timestamp('last_reminder_at')->nullable();
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
        Schema::dropIfExists('purchase_packages');
    }
}
