<?php $__env->startSection('title',trans('Listing Details')); ?>

<?php $__env->startSection('banner_heading'); ?>
    <?php echo app('translator')->get($single_listing_details->title); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('listing_thumbnail'); ?>
    <style>
        .banner-section {
            background-image: url(<?php echo e(getFile($single_listing_details->driver, $single_listing_details->thumbnail)); ?>);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <?php if(3 > count($single_listing_details->get_products)): ?>
        <style>
            .listing-details .owl-carousel .owl-nav, .listing-details .owl-carousel .owl-nav.disabled {
                display: none !important;
            }
        </style>
    <?php endif; ?>
    
    <style>
        .whatsapp_icon {
            position: fixed;
            bottom: 30px !important;
            right: 20px !important;
        }

        .whatsapp_icon a {
            position: relative;
        }

        .whatsapp_icon .notification-dot {
            position: absolute;
            top: 2px;
            right: 2px;
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background-color: red;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp_icon .notification-dot i {
            font-size: 7px;
            margin-top: 1px;
        }

        .whatsapp_icon img {
            width: 50px !important;
            border-radius: 50%;
        }

        .whatsapp-bubble {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 12px 24px 0px;
            max-width: 360px !important;
            position: fixed;
            right: 20px;
            bottom: 90px !important;
        }

        .whatsapp-bubble .card-header {
            position: relative;
            padding: 24px 20px;
        }

        .whatsapp-bubble .card {
            border: none;
        }

        .whatsapp-bubble .card-header .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
        }

        .whatsapp-bubble .card-header .close-btn i {
            font-size: 16px;
        }

        .whatsapp-bubble .card-body {
            padding: 20px 20px 20px 10px;
            background-color: rgb(230, 221, 212);
            position: relative;
            overflow: auto;
            max-height: 382px;
        }

        .whatsapp-bubble .card-body::before {
            position: absolute;
            content: "";
            left: 0px;
            top: 0px;
            height: 100%;
            width: 100%;
            z-index: 0;
            opacity: 0.08;
            background-image: url(http://127.0.0.1/listplace_codecanyon/project/assets/themes/classic/img/whatsapp-bg.webp);
        }

        .whatsapp-bubble .card-body .whatsapp-chat-text {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.13) 0px 1px 0.5px;
        }

        .whatsapp-bubble .profile {
            display: flex;
        }

        .whatsapp-bubble .profile .profile-thum {
            min-width: 52px;
            width: 52px;
            height: 52px;
            border: 1px solid rgb(0, 0, 0, 0.1);
            border-radius: 50%;
            margin-right: 10px;
            position: relative;
        }

        .whatsapp-bubble .profile .profile-thum .active-dot {
            position: absolute;
            height: 10px;
            width: 10px;
            border-radius: 50%;
            background-color: rgb(74, 213, 4);
            bottom: 4px;
            left: 40px;
            border: 1px solid white;
        }

        .whatsapp-bubble .profile .profile-thum img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .whatsapp-bubble .profile .profile-content .profile-title {
            font-weight: 600;
        }

        .whatsapp-bubble .profile .profile-content p {
            font-size: 14px;
        }

        .whatsapp-bubble .card-footer {
            padding: 20px;
        }

        .whatsapp-bubble .card-footer .btn-custom {
            width: 100%;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 25px;
            text-transform: capitalize;
        }

        .whatsapp-bubble .card-footer .btn-custom i {
            font-size: 14px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php if($single_listing_details->listingSeo): ?>
    <?php $__env->startPush('seo'); ?>
        <meta name="description" content="<?php echo e(optional($single_listing_details->listingSeo)->meta_description); ?>">
        <meta name="keywords" content="<?php echo e(optional($single_listing_details->listingSeo)->meta_keywords); ?>">
        <link rel="shortcut icon"
              href="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.favicon_image'))); ?>"
              type="image/x-icon">
        
        <link rel="apple-touch-icon"
              href="<?php echo e(getFile(optional($single_listing_details->listingSeo)->driver, optional($single_listing_details->listingSeo)->seo_image)); ?>">
        <title><?php echo app('translator')->get($basic->site_title); ?> | <?php echo e(optional($single_listing_details->listingSeo)->meta_title); ?> </title>
        <link rel="icon" type="image/png" sizes="16x16"
              href="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.favicon_image'))); ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title"
              content="<?php echo app('translator')->get($basic->site_title); ?> | <?php echo e(optional($single_listing_details->listingSeo)->meta_title); ?>">
        
        <meta itemprop="name"
              content="<?php echo app('translator')->get($basic->site_title); ?> | <?php echo e(optional($single_listing_details->listingSeo)->meta_title); ?>">
        <meta itemprop="description" content="<?php echo e(optional($single_listing_details->listingSeo)->meta_description); ?>">
        <meta itemprop="image"
              content="<?php echo e(getFile(optional($single_listing_details->listingSeo)->driver, optional($single_listing_details->listingSeo)->seo_image)); ?>">
        
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo e(optional($single_listing_details->listingSeo)->meta_title); ?>">
        <meta property="og:description" content="<?php echo e(optional($single_listing_details->listingSeo)->meta_description); ?>">
        <meta property="og:image"
              content="<?php echo e(getFile(optional($single_listing_details->listingSeo)->driver, optional($single_listing_details->listingSeo)->seo_image)); ?>"/>
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        
        <meta name="twitter:card"
              content="<?php echo e(getFile(optional($single_listing_details->listingSeo)->driver, optional($single_listing_details->listingSeo)->seo_image)); ?>">
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="header-text text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                <?php if(Request::get('region') && Request::get('category')): ?>
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/category/' . Request::get('region') . '/' . Request::get('category'))); ?>"><?php echo e(Request::get('region')); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(Request::get('category')); ?></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(Request::segment(2)); ?></li>
            </ol>
        </nav>
    </div>
</div>


    <section class="listing-details">
        <div class="overlay">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-lg-8">

                        <?php echo $__env->make($theme.'partials.xzoom_container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <!-- <div class="navigation">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <span id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                                          type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                        <a class="short-nav-item active" href="#description"><?php echo app('translator')->get('Description'); ?></a>
                                        <?php if(optional($single_listing_details->get_package)->is_video != 0 && $single_listing_details->youtube_video_id != null): ?>
                                            <a class="short-nav-item" href="#videobox"><?php echo app('translator')->get('Video'); ?></a>
                                        <?php endif; ?>
                                        <?php if(optional($single_listing_details->get_package)->is_amenities != 0 && count($single_listing_details->get_listing_amenities) > 0): ?>
                                            <a class="short-nav-item" href="#amenities"><?php echo app('translator')->get('Amenities'); ?></a>
                                        <?php endif; ?>
                                        <?php if(count($single_listing_details->get_products) == 1 && $single_listing_details->get_products[0]->product_title == null && $single_listing_details->get_products[0]->product_price == null && $single_listing_details->get_products[0]->product_description == null && $single_listing_details->get_products[0]->product_thumbnail == null): ?>
                                        <?php else: ?>
                                            <?php if(optional($single_listing_details->get_package)->is_product != 0 && count($single_listing_details->get_products) > 0): ?>
                                                <a class="short-nav-item" href="#products"><?php echo app('translator')->get('Products'); ?></a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </span>
                                </li> -->

                                <!-- <li class="nav-item ms-1" role="presentation">
                                    <span id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                                          type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                        <a class="short-nav-item" href="#reviews">
                                            <?php echo app('translator')->get('Reviews'); ?>
                                            <span class="listing__reviews">
                                                <?php
                                                    $isCheck = 0;
                                                    $j = 0;
                                                ?>

                                                <?php if($average_review != intval($average_review)): ?>
                                                    <?php
                                                        $isCheck = 1;
                                                    ?>
                                                <?php endif; ?>
                                                <?php for($i = $average_review; $i > $isCheck; $i--): ?>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <?php
                                                        $j = $j + 1;
                                                    ?>
                                                <?php endfor; ?>
                                                <?php if($average_review != intval($average_review)): ?>
                                                    <i class="fa fa-star-half-alt"></i>
                                                    <?php
                                                        $j = $j + 1;
                                                    ?>
                                                <?php endif; ?>
                                                <?php if($average_review == 0 || $average_review != null): ?>
                                                    <?php for($j; $j < 5; $j++): ?>
                                                        <i class="far fa-star"></i>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                            </span>
                                            <span class="badge bg-primary font-10">
                                                <?php echo e($single_listing_details->reviews()[0]->total); ?>

                                            </span></a>
                                    </span>
                                </li> -->
                            <!-- </ul>
                        </div> -->


                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab" tabindex="0">
                                <!-- <div id="description" class="description-box"> -->
                                <!-- <div id="description" class="">
                                    <h4><?php echo app('translator')->get('Description'); ?></h4>
                                    <p>
                                        <?php echo $single_listing_details->description; ?>

                                    </p>
                                </div> -->

                                <?php if(optional($single_listing_details->get_package)->is_video != 0 && $single_listing_details->youtube_video_id != null): ?>
                                    <div id="videobox" class="video-box">
                                        <h4><?php echo app('translator')->get('Video'); ?></h4>
                                        <iframe width="100%" height="100%"
                                                src="https://www.youtube.com/embed/<?php echo e($single_listing_details->youtube_video_id); ?>?controls=0"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                <?php endif; ?>

                                <?php if(optional($single_listing_details->get_package)->is_amenities != 0 && count($single_listing_details->get_listing_amenities) > 0): ?>
                                    <div id="amenities" class="amenities-box">
                                        <h4 class="mb-4"><?php echo app('translator')->get('Amenities'); ?></h4>
                                        <div class="row gy-4">
                                            <?php $__empty_1 = true; $__currentLoopData = $single_listing_details->get_listing_amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="col-3 col-md-2">
                                                    <div class="amenity-box">
                                                        <i class="<?php echo e(optional($amenity->get_amenity)->icon); ?>"></i>
                                                        <h6><?php echo e(optional(optional($amenity->get_amenity)->details)->title); ?></h6>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(count($single_listing_details->get_products) == 1 && $single_listing_details->get_products[0]->product_title == null && $single_listing_details->get_products[0]->product_price == null && $single_listing_details->get_products[0]->product_description == null && $single_listing_details->get_products[0]->product_thumbnail == null): ?>
                                <?php else: ?>
                                    <?php if(optional($single_listing_details->get_package)->is_product != 0 && count($single_listing_details->get_products) > 0): ?>
                                        <div id="products" class="products mb-5">
                                            <h4><?php echo app('translator')->get('Products'); ?></h4>
                                            <div class="owl-carousel products-slider">
                                                <?php $__currentLoopData = $single_listing_details->get_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="product-box">
                                                        <div class="img-box">
                                                            <img class="img-fluid"
                                                                 src="<?php echo e(getFile($listing_product->driver, $listing_product->product_thumbnail)); ?>"
                                                                 alt="<?php echo e(config('basic.site_title')); ?>"/>
                                                            <span
                                                                class="price"> $<?php echo app('translator')->get($listing_product->product_price); ?> </span>
                                                        </div>

                                                        <div class="text-box">
                                                            <p><?php echo e(Str::limit($listing_product->product_title, 20)); ?></p>
                                                        </div>

                                                        <div class="d-flex justify-content-center p-2">
                                                            <button
                                                                class="btn-custom-product listing_product_id text-uppercase"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#productDetailsModal<?php echo e($listing_product->id); ?>"
                                                                data-listingproductid="<?php echo e($listing_product->id); ?>">
                                                                <?php echo app('translator')->get('view details'); ?>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <?php $__env->startPush('frontend_modal'); ?>
                                                        <div class="modal fade product-query-modal"
                                                             id="productDetailsModal<?php echo e($listing_product->id); ?>"
                                                             tabindex="-1" aria-labelledby="productDetailsModalLabel"
                                                             aria-hidden="true" data-bs-backdrop="static">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="productDetailsModalLabel">
                                                                            <?php echo app('translator')->get($listing_product->product_title); ?>
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <div>
                                                                                    <div
                                                                                        id="mainCarousel<?php echo e($listing_product->id); ?>"
                                                                                        class="carousel mx-auto main_carousel">
                                                                                        <?php $__empty_1 = true; $__currentLoopData = $listing_product->get_product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing_product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                                                            <?php
                                                                                                $all_product_images = App\Models\ProductImage::where('product_id',$listing_product_image->product_id)->count();
                                                                                            ?>

                                                                                            <?php if($all_product_images >= 1): ?>
                                                                                                <div
                                                                                                    class="carousel__slide"
                                                                                                    data-src="<?php echo e(getFile($listing_product_image->driver, $listing_product_image->product_image)); ?>"
                                                                                                    data-fancybox="gallery"
                                                                                                    data-caption="">
                                                                                                    <img
                                                                                                        class="img-fluid"
                                                                                                        src="<?php echo e(getFile($listing_product_image->driver, $listing_product_image->product_image)); ?>"/>
                                                                                                </div>
                                                                                            <?php endif; ?>

                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                                            <div class="carousel__slide"
                                                                                                 data-src="<?php echo e(getFile($listing_product->driver, $listing_product->product_thumbnail)); ?>"
                                                                                                 data-fancybox="gallery"
                                                                                                 data-caption="">
                                                                                                <img class="img-fluid"
                                                                                                     src="<?php echo e(getFile($listing_product->driver, $listing_product->product_thumbnail)); ?>"/>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    </div>

                                                                                    <div
                                                                                        id="thumbCarousel<?php echo e($listing_product->id); ?>"
                                                                                        class="carousel max-w-xl mx-auto mb-5 thumb_carousel">
                                                                                        <?php $__empty_1 = true; $__currentLoopData = $listing_product->get_product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing_product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                                            <?php
                                                                                                $all_product_images = App\Models\ProductImage::where('product_id',$listing_product_image->product_id)->count();
                                                                                            ?>
                                                                                            <?php if($all_product_images >= 1): ?>
                                                                                                <div
                                                                                                    class="carousel__slide">
                                                                                                    <img
                                                                                                        class="panzoom__content img-fluid"
                                                                                                        src="<?php echo e(getFile($listing_product_image->driver, $listing_product_image->product_image)); ?>"/>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-7">
                                                                                <h5><?php echo app('translator')->get($listing_product->product_title); ?></h5>
                                                                                <p>
                                                                                    <?php echo app('translator')->get($listing_product->product_description); ?>
                                                                                </p>
                                                                                <h4>
                                                                                <span
                                                                                    class="text-primary"><?php echo app('translator')->get('Price'); ?>:</span>
                                                                                    <span><?php echo e($basic->currency_symbol); ?> <?php echo e($listing_product->product_price); ?></span>
                                                                                </h4>
                                                                                <div class="make-query">
                                                                                    <h5><?php echo app('translator')->get('Make Query'); ?></h5>
                                                                                    <form
                                                                                        action="<?php echo e(route('user.sendProductQuery')); ?>"
                                                                                        method="post"
                                                                                        enctype="multipart/form-data">
                                                                                        <?php echo csrf_field(); ?>
                                                                                        <input type="hidden"
                                                                                               name="product_id"
                                                                                               value="<?php echo e($listing_product->id); ?>"
                                                                                               class="form-control">
                                                                                        <input type="hidden"
                                                                                               name="listing_id"
                                                                                               value="<?php echo e(@$single_listing_details->id); ?>"
                                                                                               class="form-control">
                                                                                        <div class="row g-3">
                                                                                            <div
                                                                                                class="input-box col-12">
                                                                                                <textarea
                                                                                                    class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> text-dark"
                                                                                                    cols="30" rows="3"
                                                                                                    autocomplete="off"
                                                                                                    name="message"
                                                                                                    placeholder="<?php echo app('translator')->get('Your message'); ?>"></textarea>
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="input-box col-12">
                                                                                                <button
                                                                                                    class="btn-custom w-100">
                                                                                                    <?php echo app('translator')->get('submit'); ?>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php $__env->stopPush(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                 aria-labelledby="pills-profile-tab" tabindex="0">
                                <div id="review-app">
                                    <div id="reviews" class="reviews">
                                        <div class="customer-review">
                                            <h4><?php echo app('translator')->get('Reviews'); ?></h4>
                                            <div class="review-box" v-for="(obj, index) in item.feedArr">
                                                <div class="text">
                                                    <img :src="obj.review_user_info.imgPath"/>
                                                    <span class="name">{{obj.review_user_info.fullname}}</span>
                                                    <p class="mt-3">
                                                        {{ obj.review }}
                                                    </p>
                                                </div>
                                                <div class="review-date">
                                                  <span class="review rating-group">
                                                      <div id="half-stars-example">
                                                          <i class="fas fa-star" v-for="i in obj.rating2" :key="i"></i>
                                                      </div>
                                                  </span>
                                                    <br/>
                                                    <span class="date">{{obj.date_formatted}}</span>
                                                </div>
                                            </div>

                                            <div class="custom-not-found3" v-if="item.feedArr.length<1">
                                                <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>"
                                                     alt="<?php echo e(config('basic.site_title')); ?>" class="img-fluid">
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col d-flex justify-content-center">
                                                    <?php echo $__env->make('partials.vuePaginate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if($reviewDone <= 0 && $single_listing_details->user_id != Auth::id()): ?>
                                                <div class="add-review mb-5" v-if="item.reviewDone < 1">
                                                    <div>
                                                        <h4><?php echo app('translator')->get('Add Review'); ?></h4>
                                                    </div>
                                                    <form>
                                                        <div class="mb-3">
                                                            <p>
                                                                <?php echo app('translator')->get('Writing great reviews may help others discover the places that are just apt for them'); ?>
                                                            </p>
                                                            <div id="half-stars-example">
                                                                <div class="rating-group">
                                                                    <label aria-label="1 star" class="rating__label"
                                                                           for="rating2-10">
                                                                        <i class="rating__icon rating__icon--star fa fa-star"
                                                                           aria-hidden="true"></i>
                                                                    </label>
                                                                    <input class="rating__input" name="rating2"
                                                                           id="rating2-10" value="1" @click="rate(1)"
                                                                           type="radio"/>

                                                                    <label aria-label="2 stars" class="rating__label"
                                                                           for="rating2-20">
                                                                        <i class="rating__icon rating__icon--star fa fa-star"
                                                                           aria-hidden="true"></i>
                                                                    </label>
                                                                    <input class="rating__input" name="rating2"
                                                                           id="rating2-20" value="2" @click="rate(2)"
                                                                           type="radio"/>

                                                                    <label aria-label="3 stars" class="rating__label"
                                                                           for="rating2-30">
                                                                        <i class="rating__icon rating__icon--star fa fa-star"
                                                                           aria-hidden="true"></i>
                                                                    </label>
                                                                    <input class="rating__input" name="rating2"
                                                                           id="rating2-30" value="3" @click="rate(3)"
                                                                           type="radio"/>

                                                                    <label aria-label="4 stars" class="rating__label"
                                                                           for="rating2-40">
                                                                        <i class="rating__icon rating__icon--star fa fa-star"
                                                                           aria-hidden="true"></i>
                                                                    </label>
                                                                    <input class="rating__input" name="rating2"
                                                                           id="rating2-40" value="4" @click="rate(4)"
                                                                           type="radio"/>

                                                                    <label aria-label="5 stars" class="rating__label"
                                                                           for="rating2-50">
                                                                        <i class="rating__icon rating__icon--star fa fa-star"
                                                                           aria-hidden="true"></i>
                                                                    </label>
                                                                    <input class="rating__input" name="rating2"
                                                                           id="rating2-50" value="5" checked=""
                                                                           type="radio" @click="rate(5)"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label for="exampleFormControlTextarea1"
                                                                   class="form-label"><?php echo app('translator')->get('Your message'); ?></label>
                                                            <textarea class="form-control text-dark"
                                                                      id="exampleFormControlTextarea1" name="review"
                                                                      v-model="item.feedback" rows="5"></textarea>
                                                            <span class="text-danger">{{ error.feedbackError }}</span>
                                                        </div>
                                                        <button class="btn-custom mt-2"
                                                                @click.prevent="addFeedback"><?php echo app('translator')->get('Submit now'); ?></button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="add-review mb-5 add__review__login" v-if="item.reviewDone < 1">
                                                <div class="d-flex justify-content-between">
                                                    <h4><?php echo app('translator')->get('Add Review'); ?></h4>
                                                </div>
                                                <a href="<?php echo e(route('login')); ?>"
                                                   class="btn btn-primary btn-sm h-25"><?php echo app('translator')->get('Login to review'); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="side-bar">
                            <div class="side-box">
                                <!-- <h5><?php echo app('translator')->get('Created By'); ?></h5> -->
                                <div class="creator-box">
                                    <div class="">
                                        <!-- <img
                                            src="<?php echo e(getFile(optional($single_listing_details->get_user)->cover_driver, optional($single_listing_details->get_user)->cover_photo)); ?>"
                                            alt="<?php echo e(config('basic.site_title')); ?>" class="img-fluid cover"/> -->
                                        <img
                                            src="<?php echo e(getFile($single_listing_details->driver, $single_listing_details->thumbnail)); ?>"
                                            class="img-fluid profile" alt="<?php echo e(config('basic.site_title')); ?>"/>
                                    </div>

                                    <!-- <div class="text-box">
                                        <h5 class="creator-name">
                                            <?php echo app('translator')->get(optional($single_listing_details->get_user)->firstname); ?> <?php echo app('translator')->get(optional($single_listing_details->get_user)->lastname); ?>
                                        </h5>
                                        <span><?php echo app('translator')->get('Member since'); ?> <?php echo app('translator')->get(optional($single_listing_details->get_user)->created_at->format('M Y')); ?> </span>
                                        <div class="d-flex justify-content-between my-3">
                                            <span>
                                                <?php if($total_listings_an_user['totalListing'] > 1): ?>
                                                    <?php echo e($total_listings_an_user['totalListing']); ?> <?php echo app('translator')->get('Listings'); ?>
                                                <?php else: ?>
                                                    <?php echo e($total_listings_an_user['totalListing']); ?> <?php echo app('translator')->get('Listing'); ?>
                                                <?php endif; ?>
                                            </span>
                                            <span><?php echo e($follower_count['totalFollower']); ?> <?php echo app('translator')->get('Followers'); ?></span>
                                        </div> -->

                                        <!-- <a href="<?php echo e(route('profile', [slug(optional($single_listing_details->get_user)->firstname), optional($single_listing_details->get_user)->id])); ?>"
                                           class="btn-custom cursor-pointer">
                                            <?php echo app('translator')->get('Visit profile'); ?>
                                        </a> -->
                                    <!-- </div>
                                </div>
                            </div> -->

                            <!-- <?php if(optional($single_listing_details->get_package)->is_business_hour != 0 && count($single_listing_details->get_business_hour) > 0): ?>
                                <div class="side-box">
                                    <h5><?php echo app('translator')->get('Opening Hours'); ?></h5>
                                    <ul>
                                        <?php $__empty_1 = true; $__currentLoopData = $single_listing_details->get_business_hour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business_hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($business_hour->start_time): ?>
                                                <li>
                                                    <?php echo app('translator')->get($business_hour->working_day); ?>
                                                    <span class="float-end"><?php echo e(\Carbon\Carbon::parse($business_hour->start_time)->format('h a')); ?> - <?php echo e(\Carbon\Carbon::parse($business_hour->end_time)->format('h a')); ?></span>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <?php echo app('translator')->get($business_hour->working_day); ?>
                                                    <span class="float-end"><?php echo app('translator')->get('Closed'); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?> -->

                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="side-box">
                                <!-- <h5><?php echo app('translator')->get('Contact Seller'); ?></h5> -->
                                <ul>
                                    <?php if(optional($single_listing_details->get_user)->phone): ?>
                                        <li>
                                            <i class="far fa-phone-alt" aria-hidden="true"></i>
                                            <span><?php echo e(optional($single_listing_details->get_user)->phone); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(optional($single_listing_details->get_user)->email): ?>
                                        <li>
                                            <i class="far fa-envelope" aria-hidden="true"></i>
                                            <span><?php echo e(optional($single_listing_details->get_user)->email); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(optional($single_listing_details->get_user)->address): ?>
                                        <li>
                                            <i class="far fa-map-marker-alt" aria-hidden="true"></i>
                                            <span><?php echo e(optional($single_listing_details->get_user)->address); ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                <?php if(count(optional($single_listing_details->get_user)->get_social_links_user) > 0): ?>
                                    <div class="social-links mt-4">
                                        <?php $__currentLoopData = optional($single_listing_details->get_user)->get_social_links_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e($social->social_url); ?>" target="_blank">
                                                <i class="<?php echo e($social->social_icon); ?>" aria-hidden="true"></i>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <div id="mainCarousel" class="carousel mx-auto main_carousel">
        <?php $__empty_1 = true; $__currentLoopData = $single_listing_details->get_listing_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="carousel__slide" data-src="<?php echo e(getFile($listing_image->driver, $listing_image->listing_image)); ?>" data-fancybox="gallery" data-caption="">
                <img class="img-fluid" src="<?php echo e(getFile($listing_image->driver, $listing_image->listing_image)); ?>"/>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="carousel__slide" data-src="<?php echo e(getFile($single_listing_details->driver, $single_listing_details->thumbnail)); ?>" data-fancybox="gallery" data-caption="">
                <img class="img-fluid" src="<?php echo e(getFile($single_listing_details->driver, $single_listing_details->thumbnail)); ?>"/>
            </div>
        <?php endif; ?>
    </div>
                            <!--<div class="side-box">
                                <h5><?php echo app('translator')->get('Send a Message'); ?></h5>
                                <form action="<?php echo e(route('user.sendListingMessage', $id)); ?>" method="post"
                                      enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row g-3">
                                        <div class="input-box col-12">
                                            <input class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                                   autocomplete="off" name="name"
                                                   <?php if(Auth::check() == true && Auth::id() != $single_listing_details->user_id): ?>
                                                   value="<?php echo app('translator')->get(Auth::user()->firstname); ?> <?php echo app('translator')->get(Auth::user()->lastname); ?>"
                                                   <?php else: ?>
                                                   placeholder="<?php echo app('translator')->get('Full Name'); ?>"
                                                <?php endif; ?>/>
                                            <div class="invalid-feedback">
                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="input-box col-12">
                                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                      cols="30" rows="3" autocomplete="off" name="message"
                                                      placeholder="<?php echo app('translator')->get('Your message'); ?>"></textarea>
                                            <div class="invalid-feedback">
                                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                              div       </div>
                                        <div class="input-box col-12">
                                            <button class="btn-custom w-100">
                                                <?php echo app('translator')->get('submit'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="side-box claim-business">
                                <div class="d-flex align-items-center">
                                    <img
                                        src="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.logo_image'))); ?>"
                                        class="img-fluid" alt=""/>
                                    <div>
                                        <h5><?php echo app('translator')->get('Claim This Business'); ?></h5>
                                        <button class="btn-custom" data-bs-toggle="modal"
                                                data-bs-target="#claimBusiness">
                                            <?php echo app('translator')->get('Claim'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <?php $__env->startPush('frontend_modal'); ?>
        <div class="modal fade" id="claimBusiness" tabindex="-1" aria-labelledby="claimBusinessLabel" aria-hidden="true"
             data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="claimBusinessLabel">
                            <?php echo app('translator')->get('Claim Business'); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('user.claimBusiness', $id)); ?>" method="post"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row g-3">
                                <div class="input-box col-12">
                                    <input class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                           autocomplete="off" name="name"
                                           <?php if(Auth::check() == true && Auth::user()->id != $single_listing_details->user_id): ?>
                                           value="<?php echo app('translator')->get(Auth::user()->firstname); ?> <?php echo app('translator')->get(Auth::user()->lastname); ?>"
                                           <?php else: ?>
                                           placeholder="<?php echo app('translator')->get('Full Name'); ?>"
                                        <?php endif; ?>/>
                                    <div class="invalid-feedback">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="input-box col-12">
                                    <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="30"
                                              rows="3" autocomplete="off" name="message"
                                              placeholder="<?php echo app('translator')->get('Your message'); ?>"></textarea>
                                    <div class="invalid-feedback">
                                        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="input-box col-12">
                                    <button class="btn-custom w-100">
                                        <?php echo app('translator')->get('submit'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php if(optional($single_listing_details->get_package)->is_whatsapp == 1): ?>
    <?php $__env->startPush('whatsapp_chat'); ?>
        <?php echo $__env->make($theme.'whatsapp_chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if(optional($single_listing_details->get_package)->is_messenger == 1): ?>
    <?php if($single_listing_details->fb_app_id): ?>
        <?php $__env->startPush('fb_messenger_chat'); ?>
            <!--start of Facebook Messenger Script-->
            <div id="fb-root"></div>
            <script>
                var fb_app_id = "<?php echo e(trim($single_listing_details->fb_app_id)); ?>";
                window.fbAsyncInit = function () {
                    FB.init({
                        appId: fb_app_id,
                        autoLogAppEvents: true,
                        xfbml: true,
                        version: 'v10.0'
                    });
                };
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>


            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
            <div class="fb-customerchat" page_id="<?php echo e(trim($single_listing_details->fb_page_id)); ?>"></div>
            <!--End of Facebook Messenger Script-->
        <?php $__env->stopPush(); ?>
    <?php endif; ?>
<?php endif; ?>

<?php $__env->startPush('css-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.carousel.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.theme.default.min.css')); ?>"/>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-js'); ?>
    <!-- fancybox slider -->
    <script src="<?php echo e(asset($themeTrue.'js/fancybox.umd.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset($themeTrue.'js/carousel.js')); ?>"></script>
    <script>
        'use strict'
        $(document).ready(function () {

            $('#bubble-btn').on('click', function () {
                $('.pasa').removeClass('opacity-0');
                $('.pasa').addClass('opacity-100');
                $('.whatsapp-bubble').fadeIn();
            });

            $('.close-btn').on('click', function () {
                $('.whatsapp-bubble').fadeOut();
            });

            $('.listing_product_id').on('click', function () {
                let listingProductId = $(this).data('listingproductid');
                const mainCarousel2 = new Carousel(document.querySelector(`#mainCarousel${listingProductId}`), {
                    Dots: false,
                });

                // Thumbnails
                const thumbCarousel2 = new Carousel(document.querySelector(`#thumbCarousel${listingProductId}`), {
                    Sync: {
                        target: mainCarousel2,
                        friction: 0,
                    },
                    Dots: false,
                    Navigation: false,
                    center: true,
                    slidesPerPage: 1,
                    infinite: true,
                });

                // Customize Fancybox
                Fancybox.bind('[data-fancybox="gallery"]', {
                    Carousel: {
                        on: {
                            change: (that) => {
                                mainCarousel2.slideTo(mainCarousel2.findPageForSlide(that.page), {
                                    friction: 0,
                                });
                            },
                        },
                    },
                });
            });

            $('.wishList').on('click', function () {
                var _this = this.id;
                let user_id = $(this).data('user');
                let listing_id = $(this).data('listing');
                let purchase_package_id = $(this).data('purchase');
                if (isAuthenticate == 1) {
                    wishList(user_id, listing_id, purchase_package_id, _this);
                } else {
                    window.location.href = '<?php echo e(route('login')); ?>';
                }
            });


            $(".products-slider").owlCarousel({
                loop: "<?php echo e(3 < count($single_listing_details->get_products) ?true:false); ?>",
                margin: 15,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1,
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: 3,
                    },
                },
            });
        });

        var newApp = new Vue({
            el: "#review-app",
            data: {
                item: {
                    feedback: "",
                    listingId: '',
                    feedArr: [],
                    reviewDone: "",
                    rating: "",
                },

                pagination: [],
                links: [],
                error: {
                    feedbackError: ''
                }
            },
            beforeMount() {
                let _this = this;
                _this.getReviews()
            },
            mounted() {
                let _this = this;
                _this.item.listingId = "<?php echo e($single_listing_details->id); ?>"
                _this.item.reviewDone = "<?php echo e($reviewDone); ?>"
                _this.item.rating = "5";
            },
            methods: {
                rate(rate) {
                    this.item.rating = rate;
                },
                addFeedback() {
                    let item = this.item;
                    this.makeError();
                    axios.post("<?php echo e(route('user.review.push')); ?>", this.item)
                        .then(function (response) {
                            if (response.data.status == 'success') {
                                item.feedArr.unshift({
                                    review: response.data.data.review,
                                    review_user_info: response.data.data.review_user_info,
                                    rating2: parseInt(response.data.data.rating2),
                                    date_formatted: response.data.data.date_formatted,
                                });
                                item.reviewDone = 5;
                                item.feedback = "";
                                Notiflix.Notify.Success("Review done");
                            }

                        })
                        .catch(function (error) {

                        });
                },
                makeError() {
                    if (!this.item.feedback) {
                        this.error.feedbackError = "Your review message field is required"
                    }
                },

                getReviews() {
                    var app = this;
                    axios.get("<?php echo e(route('api-listingReviews',[$single_listing_details->id])); ?>")
                        .then(function (res) {
                            app.item.feedArr = res.data.data.data;
                            app.pagination = res.data.data;
                            app.links = res.data.data.links;
                            app.links = app.links.slice(1, -1);
                        })

                },
                updateItems(page) {
                    var app = this;
                    if (page == 'back') {
                        var url = this.pagination.prev_page_url;
                    } else if (page == 'next') {
                        var url = this.pagination.next_page_url;
                    } else {
                        var url = page.url;
                    }
                    axios.get(url)
                        .then(function (res) {
                            app.item.feedArr = res.data.data.data;
                            app.pagination = res.data.data;
                            app.links = res.data.data.links;
                        })
                },
            }
        })


        var isAuthenticate = '<?php echo e(\Illuminate\Support\Facades\Auth::check()); ?>';

        function wishList(user_id = null, listing_id = null, purchase_package_id = null, id = null) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('user.wishList')); ?>",
                type: "POST",
                data: {
                    user_id: user_id,
                    listing_id: listing_id,
                    purchase_package_id: purchase_package_id
                },
                success: function (data) {
                    if (data.data == 'added') {
                        $(`.save${id}`).removeClass("fal fa-heart");
                        $(`.save${id}`).addClass("fas fa-heart");
                        Notiflix.Notify.Success("Wishlist added");
                    }
                    if (data.data == 'remove') {
                        $(`.save${id}`).removeClass("fas fa-heart");
                        $(`.save${id}`).addClass("fal fa-heart");
                        Notiflix.Notify.Success("Wishlist removed");
                    }
                },
            });
        }
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/listing_details.blade.php ENDPATH**/ ?>