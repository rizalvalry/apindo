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
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="listing-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-sm-12 my-4">
                    <form action="<?php echo e(route('listing')); ?>" method="get">
                        <div class="filter-area">
                            <div class="filter-box">
                                <h5><?php echo app('translator')->get('search'); ?></h5>
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control"
                                           value="<?php echo e(old('name', request()->name)); ?>" autocomplete="off"
                                           placeholder="<?php echo app('translator')->get('Listing name'); ?>"/>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="js-example-basic-single form-control" name="location">
                                        <option selected disabled><?php echo app('translator')->get('Select Location'); ?></option>
                                        <option value="all" <?php if(request()->location == 'all'): ?> selected <?php endif; ?>><?php echo app('translator')->get('All Location'); ?></option>
                                        <?php $__currentLoopData = $all_places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="m-0" value="<?php echo e($place->id); ?>" <?php if(request()->location == $place->id): ?> selected <?php endif; ?>><?php echo app('translator')->get(optional($place->details)->place); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="listing__category__select2 form-control" name="category[]" multiple>
                                        <option value="all" <?php if(request()->category && in_array('all', request()->category)): ?> selected <?php endif; ?>><?php echo app('translator')->get('All Category'); ?></option>
                                        <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php if(request()->category && in_array($category->id, request()->category)): ?> selected <?php endif; ?>> <?php echo app('translator')->get(optional($category->details)->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-box">
                                <h5><?php echo app('translator')->get('Filter by User'); ?></h5>
                                <div class="input-group mb-3">
                                    <select class="js-example-basic-single form-control" name="user">
                                        <option selected disabled><?php echo app('translator')->get('Select User'); ?></option>
                                        <option value="all" <?php if(request()->user == 'all'): ?> selected <?php endif; ?>><?php echo app('translator')->get('All User'); ?></option>
                                        <?php $__currentLoopData = $distinctUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>" <?php if(request()->user == $user->id): ?> selected <?php endif; ?>><?php echo app('translator')->get($user->fullname); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-box">
                                <h5><?php echo app('translator')->get('Filter by Ratings'); ?></h5>
                                <div class="check-box">
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo e($i); ?>" name="rating[]" id="check<?php echo e($i); ?>"
                                                   <?php if(isset(request()->rating) && in_array($i, request()->rating)): ?> checked <?php endif; ?>/>
                                            <label class="form-check-label" for="check<?php echo e($i); ?>">
                                                <?php for($j = 1; $j <= $i; $j++): ?>
                                                    <i class="fas fa-star"></i>
                                                <?php endfor; ?>
                                                <?php for($j = $i; $j < 5; $j++): ?>
                                                    <i class="far fa-star"></i>
                                                <?php endfor; ?>
                                            </label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <button class="btn-custom w-100" type="submit"><?php echo app('translator')->get('submit'); ?></button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-10 col-lg-10 col-sm-12 my-4">
                    <?php if(count($all_listings) > 0): ?>
                        <div class="row g-4">
                            <?php $__empty_1 = true; $__currentLoopData = $all_listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $total = $listing->reviews()[0]->total;
                                    $average_review = $listing->reviews()[0]->average;
                                ?>
                                <div class="col-12">
                                    <div class="jumbotron" data-lat="<?php echo e($listing->lat); ?>" data-long="<?php echo e($listing->long); ?>" data-title="<?php echo app('translator')->get(Str::limit($listing->title, 30)); ?>" data-location="<?php echo app('translator')->get($listing->address); ?>" data-route="<?php echo e(route('listing-details', [slug($listing->title), $listing->id])); ?>">
                                        <div class="text-box">
                                            <div class="review">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?php echo e($i <= $average_review ? '' : ($i - 1 < $average_review ? '-half-alt' : '-empty')); ?>"></i>
                                                <?php endfor; ?>
                                                <!-- <span>(<?php echo app('translator')->get($total . ' reviews'); ?>)</span> -->
                                            </div>

                                            <h5 class="title"><?php echo app('translator')->get(Str::limit($listing->title, 30)); ?></h5>
                                            <a class="author" href="<?php echo e(route('profile', [slug(optional($listing->get_user)->firstname), optional($listing->get_user)->id])); ?>">
                                                <?php echo app('translator')->get(optional($listing->get_user)->firstname); ?> <?php echo app('translator')->get(optional($listing->get_user)->lastname); ?>
                                            </a>
                                            <p class="mb-2">
                                                <span class=""><?php echo app('translator')->get('Category'); ?>: </span> <?php echo e(optional($listing)->getCategoriesName()); ?>

                                            </p>
                                            <p class="address mt-1">
                                                <i class="fal fa-map-marker-alt"></i>
                                                <?php echo app('translator')->get($listing->address); ?>, <?php echo app('translator')->get(optional(optional($listing->get_place)->details)->place); ?>
                                            </p>
                                            <a href="<?php echo e(route('listing-details', [slug($listing->title), $listing->id])); ?>" class="btn-custom"><?php echo app('translator')->get('View details'); ?></a>
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

                <!-- <div class="col-xl-4 col-lg-4 col-sm-12">
                    <div class="h-100" id="map"></div>
                </div> -->
            </div>
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