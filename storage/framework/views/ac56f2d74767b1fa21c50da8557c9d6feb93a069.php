<!-- popular listings -->
<?php if(count($popularListings) > 0): ?>
    <section class="popular-listings">
        <div class="overlay">
            <div class="container">
                <?php if(isset($templates['popular-listing'][0]) && $popularListing = $templates['popular-listing'][0]): ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="header-text text-center mb-5">
                                <h3><?php echo app('translator')->get(optional($popularListing->description)->title); ?></h3>
                                <p class="mx-auto">
                                    <?php echo app('translator')->get(optional($popularListing->description)->sub_title); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $popularListings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $total = $listing->reviews()[0]->total;
                            $average_review = $listing->reviews()[0]->average;
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="listing-box">
                                <div class="img-box">
                                    <img class="img-fluid" src="<?php echo e(getFile($listing->driver, $listing->thumbnail)); ?>" alt="<?php echo e(config('basic.site_title')); ?>"/>
                                    <button class="save wishList" type="button" id="<?php echo e($key); ?>" data-user="<?php echo e(optional($listing->get_user)->id); ?>" data-purchase="<?php echo e($listing->purchase_package_id); ?>" data-listing="<?php echo e($listing->id); ?>">
                                        <?php if($listing->get_favourite_count > 0): ?>
                                            <i class="fas fa-heart save<?php echo e($key); ?>"></i>
                                        <?php else: ?>
                                            <i class="fal fa-heart save<?php echo e($key); ?>"></i>
                                        <?php endif; ?>
                                    </button>
                                </div>
                                <div class="text-box">
                                    <div class="review">
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
                                            <i class="fas fa-star-half-alt"></i>
                                            <?php
                                                $j = $j + 1;
                                            ?>
                                        <?php endif; ?>

                                        <?php if($average_review == 0 || $average_review != null): ?>
                                            <?php for($j; $j < 5; $j++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                        <span>(<?php echo app('translator')->get($total.' reviews'); ?>)</span>
                                    </div>
                                    <a class="title"
                                       href="<?php echo e(route('listing-details',[slug($listing->title), $listing->id])); ?>">
                                        <?php echo app('translator')->get(Str::limit($listing->title, 20)); ?>
                                    </a>
                                    <p class="mb-2 mt-2">
                                        <span class=""><?php echo app('translator')->get('Category'); ?>: </span> <?php echo e(optional($listing)->getCategoriesName()); ?>

                                    </p>
                                    <a class="author" href="<?php echo e(route('profile', [slug(optional($listing->get_user)->firstname), optional($listing->get_user)->id])); ?>"> <?php echo app('translator')->get(optional($listing->get_user)->firstname); ?> <?php echo app('translator')->get(optional($listing->get_user)->lastname); ?> </a>
                                    <p class="address">
                                        <i class="fal fa-map-marker-alt"></i>
                                        <?php echo app('translator')->get($listing->address); ?>, <?php echo app('translator')->get(optional(optional($listing->get_place)->details)->place); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <?php endif; ?>

                </div>
                <div class="row text-center mt-5">
                    <div class="col">
                        <a href="<?php echo e(route('listing').'?popular'); ?>" class="btn-custom">
                            <?php echo app('translator')->get('View More'); ?>
                            <i class="fal fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'
        var isAuthenticate = '<?php echo e(\Illuminate\Support\Facades\Auth::check()); ?>';

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



<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/listing.blade.php ENDPATH**/ ?>