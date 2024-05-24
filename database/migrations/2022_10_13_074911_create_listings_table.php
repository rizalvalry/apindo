<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->nullable();
            $table->foreignId('category_id')->index()->nullable();
            $table->foreignId('purchase_package_id')->index()->nullable();
            $table->foreignId('place_id')->index()->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('youtube_video_id')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('status')->default(0);
            $table->longText('rejected_reason')->nullable();
            $table->longText('deactive_reason')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('listings');
    }
}
