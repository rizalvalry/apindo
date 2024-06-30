
<?php $__env->startSection('title', trans('Listing')); ?>

<?php $__env->startSection('banner_heading'); ?>
    <?php echo app('translator')->get('All Listings'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/frontend_leaflet.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/frontendControl.FullScreen.css')); ?>"/>
    <style>
        .jumbotron {
            width: 100%;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #e9ecef;
            border-radius: .3rem;
        }
        .jumbotron .img-box {
            display: none;
        }
        .filter-area {
            margin-bottom: 20px;
        }
        .filter-box {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .filter-box h5 {
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .filter-box .input-group {
            margin-bottom: 15px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .btn-custom:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="header-text text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                <?php if(Request::get('region')): ?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(url('category/' . ucfirst(Request::get('region')))); ?>">
                            <?php echo e(ucfirst(Request::get('region'))); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(Request::segment(2)); ?></li>
            </ol>
        </nav>
    </div>
</div>


<section class="listing-section">
    <div class="container">
        <div class="row">
            <!-- Search Section -->
            <div class="col-12">
                <form action="<?php echo e(route('listing')); ?>" method="get" class="justify-content-between w-100">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', request()->name)); ?>" autocomplete="off" placeholder="<?php echo app('translator')->get('Listing name'); ?>" style="background-color: #e9ecef; height: 3rem;">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mb-3">
                            <select class="js-example-basic-single form-control" name="location">
                                <option selected disabled><?php echo app('translator')->get('Select Location'); ?></option>
                                <option value="all" <?php if(request()->location == 'all'): ?> selected <?php endif; ?>><?php echo app('translator')->get('All Location'); ?></option>
                                <?php $__currentLoopData = $all_places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $locationDetail = optional($place->details)->place;
                                        $locationParts = explode(' ', $locationDetail);
                                        $firstWord = rtrim($locationParts[0], ',');
                                    ?>
                                    <option class="m-0" value="<?php echo e($place->id); ?>" <?php if(request()->location == $place->id): ?> selected <?php endif; ?>><?php echo e($firstWord); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mb-3">
                                <select class="listing__category__select2 form-control" name="category[]" multiple>
                                    <option value="all" <?php if(request()->category && in_array('all', request()->category)): ?> selected <?php endif; ?>><?php echo app('translator')->get('All Category'); ?></option>
                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php if(request()->category && in_array($category->id, request()->category)): ?> selected <?php endif; ?>> <?php echo app('translator')->get(optional($category->details)->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mb-3">
                                <button class="btn btn-primary btn-lg" style="height: 3rem; width:100%;" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>

                
           
                <?php if(count($all_listings) > 0): ?>
                    <div class="row g-0 d-flex justify-content-sm-center">
                        <?php $__empty_1 = true; $__currentLoopData = $all_listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                            <?php
                                $total = $listing->reviews()[0]->total;
                                $average_review = $listing->reviews()[0]->average;
                            ?>
                                <div class="jumbotron d-flex justify-content-center" style="padding:1rem;" data-lat="<?php echo e($listing->lat); ?>" data-long="<?php echo e($listing->long); ?>" data-title="<?php echo app('translator')->get(Str::limit($listing->title, 30)); ?>" data-location="<?php echo app('translator')->get($listing->address); ?>" data-route="<?php echo e(route('listing-details', [slug($listing->title), $listing->id])); ?>">
                                    <div class="col-sm-2 m-4">
                                        <img class="img-fluid" style="border-radius:5px;" src="<?php echo e(getFile($listing->driver, $listing->thumbnail)); ?>" alt="<?php echo app('translator')->get(Str::limit($listing->title, 30)); ?>">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="text-box">
                                            <div class="review">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?php echo e($i <= $average_review ? '' : ($i - 1 < $average_review ? '-half-alt' : '-empty')); ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <a href="<?php echo e(route('listing-details', [slug($listing->title), $listing->id])); ?>?region=<?php echo e(Request::get('region')); ?>&category=<?php echo e(Request::segment(2)); ?>&id=<?php echo e(Request::segment(3)); ?>"><h5 class="title"><?php echo app('translator')->get(Str::limit($listing->title, 30)); ?></h5></a>
                                            <p class="address mt-1">
                                                <i class="fal fa-map-marker-alt"></i>
                                                <?php echo app('translator')->get($listing->address); ?>, <?php echo app('translator')->get(optional(optional($listing->get_place)->details)->place); ?>
                                            </p>
                                            <span class="badge bg-secondary">
                                                <?php echo e(optional($listing)->getCategoriesName()); ?>

                                            </span>
                                            <span class="badge bg-secondary">
                                            <?php if(optional($listing)->getCategoriesName() == "Shopping"): ?> 
                                                    Kontrak
                                                <?php else: ?>
                                                    Permanent
                                                <?php endif; ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="custom-not-found">
                                <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="img-fluid">
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-12 d-flex justify-content-center mt-5">
                            <nav aria-label="Page navigation example mt-3">
                                <?php echo e($all_listings->appends($_GET)->links()); ?>

                            </nav>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="custom-not-found">
                        <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="img-fluid">
                    </div>
                <?php endif; ?>
            </div>
            <!-- End Listing Section -->
      
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/frontend_leaflet.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/frontendControl.FullScreen.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/frontend_map.js')); ?>"></script>
    <script>
        'use strict'

        $(".listing__category__select2").select2({
            width: '100%',
            placeholder: '<?php echo app('translator')->get("Select Categories"); ?>',
        });

        var isAuthenticate = '<?php echo e(Auth::check()); ?>';

        $(document).ready(function () {
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
        });

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

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/listing.blade.php ENDPATH**/ ?>