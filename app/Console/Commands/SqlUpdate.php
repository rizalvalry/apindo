<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SqlUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $checkFiles = file_exists('assets/listplace-v3.txt');
        if (!$checkFiles) {
            DB::statement("ALTER TABLE `place_details` DROP INDEX `place`;");

            DB::statement("ALTER TABLE `gateways` CHANGE `note` `note` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");


            DB::statement("ALTER TABLE `listings` CHANGE `category_id` `category_id` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
            DB::statement('UPDATE listings SET category_id  = CONCAT("[", category_id ,"]"), driver = "local";');

            $listing_imageLocation = config('location.listing.path');
            DB::statement("UPDATE listing_images SET listing_image = CONCAT('$listing_imageLocation/', listing_image ), driver = 'local';");

            $blogpath = config('location.blog.path');
            DB::statement("UPDATE blogs SET image = CONCAT('$blogpath/', image ), driver = 'local';");


            $gatewaypath = config('location.gateway.path');
            DB::statement("UPDATE gateways SET image = CONCAT('$gatewaypath/', image ), driver = 'local';");

            $listingsThumbpath = config('location.listing_thumbnail.path');
            DB::statement("UPDATE listings SET thumbnail = CONCAT('$listingsThumbpath/', thumbnail ), driver = 'local';");

            $listingspath = config('location.listing.path');
            DB::statement("UPDATE listing_images SET listing_image = CONCAT('$listingspath/', listing_image ), driver = 'local';");

            $listingsSeopath = config('location.listing_seo.path');
            DB::statement("UPDATE listing_seos SET seo_image = CONCAT('$listingsSeopath/', seo_image ), driver = 'local';");

            $packagespath = config('location.package.path');
            DB::statement("UPDATE packages SET image = CONCAT('$packagespath/', image ), driver = 'local';");

            $product_thumbnail = config('location.product_thumbnail.path');
            DB::statement("UPDATE products SET product_thumbnail = CONCAT('$product_thumbnail/', product_thumbnail ), driver = 'local';");

            $product_image = config('location.product.path');
            DB::statement("UPDATE product_images SET product_image = CONCAT('$product_image/', product_image ), driver = 'local';");


            $product_replies = config('location.message.path');
            DB::statement("UPDATE product_replies SET file = CONCAT('$product_replies/', file ), driver = 'local';");

            $templatePath = config('location.content.path');
            DB::table('template_media')->get()->map(function ($item) use ($templatePath) {
                $newArr = [];
                foreach (json_decode($item->description) as $key => $value) {
                    if ($key == 'image') {
                        $newArr[$key] = $templatePath . '/' . $value;
                    } else {
                        $newArr[$key] = $value;
                    }
                }
                $ID = $item->id;

                DB::table('template_media')
                    ->where('id', $ID)
                    ->update(['description' => $newArr]);
            });

            $contentPath = config('location.content.path');
            DB::table('content_media')->get()->map(function ($item) use ($contentPath) {
                $newArr = [];
                foreach (json_decode($item->description) as $key => $value) {
                    if ($key == 'image') {
                        $newArr[$key] = $contentPath . '/' . $value;
                    } else {
                        $newArr[$key] = $value;
                    }
                }
                $ID = $item->id;

                DB::table('content_media')
                    ->where('id', $ID)
                    ->update(['description' => $newArr]);
            });


            $user = config('location.user.path');
            DB::statement("UPDATE users SET image = CONCAT('$user/', image ), driver = 'local';");
            DB::statement("UPDATE users SET cover_photo = CONCAT('$user/', cover_photo ), cover_driver = 'local';");

            $user = config('location.ticket.path');
            DB::statement("UPDATE ticket_attachments SET image = CONCAT('$user/', image ), driver = 'local';");


            file_put_contents("assets/listplace-v3.txt", time());
        }
    }
}
