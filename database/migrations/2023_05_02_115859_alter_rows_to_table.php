<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRowsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Done
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('image');
        });
        // Done
        Schema::table('gateways', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('image');
        });

        // Done
        Schema::table('listings', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('thumbnail');
            $table->string('fb_app_id')->nullable();
            $table->string('fb_page_id')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->text('replies_text')->nullable();
            $table->longText('body_text')->nullable();
        });

        // Done
        Schema::table('listing_images', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('listing_image');
        });
        // Done
        Schema::table('listing_seos', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('seo_image');
        });
        // Done
        Schema::table('packages', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('image');
            $table->integer('no_of_categories_per_listing')->default(1);
            $table->boolean('is_whatsapp')->default(0);
            $table->boolean('is_messenger')->default(0);
        });
        // Done
        Schema::table('products', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('product_thumbnail');
        });
        // Done
        Schema::table('product_images', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('product_image');
        });
        // Done
        Schema::table('product_replies', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('file');
        });

        Schema::table('purchase_packages', function (Blueprint $table) {
            $table->integer('no_of_categories_per_listing')->default(1);
            $table->boolean('is_whatsapp')->default(0);
            $table->boolean('is_messenger')->default(0);
        });
        // Done
        Schema::table('template_media', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('description');
        });


        // Done
        Schema::table('content_media', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local');
        });

        // Done
        Schema::table('users', function (Blueprint $table) {
            $table->string('cover_driver')->nullable()->default('local')->after('cover_photo');
            $table->string('driver', 40)->nullable()->default('local')->after('image');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('image');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('driver', 40)->nullable()->default('local')->after('image');
        });

        Schema::table('languages', function (Blueprint $table) {
            $table->boolean('default_lang')->default(0);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('driver');
        });
        Schema::table('content_media', function (Blueprint $table) {
            $table->dropColumn('driver');
        });
        Schema::table('gateways', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('driver');
            $table->dropColumn('fb_app_id');
            $table->dropColumn('fb_page_id');
            $table->dropColumn('whatsapp_number');
            $table->dropColumn('replies_text');
            $table->dropColumn('body_text');
        });


        Schema::table('listing_images', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('listing_seos', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('driver');
            $table->dropColumn('no_of_categories_per_listing');
            $table->dropColumn('is_whatsapp');
            $table->dropColumn('is_messenger');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('product_replies', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('purchase_packages', function (Blueprint $table) {
            $table->dropColumn('no_of_categories_per_listing');
            $table->dropColumn('is_whatsapp');
            $table->dropColumn('is_messenger');
        });

        Schema::table('template_media', function (Blueprint $table) {
            $table->dropColumn('driver');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cover_driver');
            $table->dropColumn('driver');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            $table->dropColumn('driver');
        });


        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('default_lang');
        });

    }
}
