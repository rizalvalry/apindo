
<?php $__env->startSection('title', trans('Category')); ?>

<?php $__env->startSection('banner_heading'); ?>
   <?php echo app('translator')->get('Listing Category'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="header-text text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                <?php if(Request::segment(2)): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(Request::segment(2)); ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('Listing Category'); ?></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>

<?php if($allListingsAndCategory->count() > 0): ?>
    <section class="category-section">
        <div class="container">
            <div class="row g-3 g-lg-4">
                <?php $__empty_1 = true; $__currentLoopData = $allListingsAndCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-xl-3 col-md-6 col-6">
                        <a href="<?php echo e(route('listing', [slug(optional($category->details)->name)])); ?>?region=<?php echo e(Request::segment(2)); ?>">
                            <div class="category-box">
                                <div class="icon-box">
                                    <i class="<?php echo e($category->icon); ?>"></i>
                                </div>
                                <div>
                                    <h5><?php echo app('translator')->get(optional($category->details)->name); ?></h5>
                                    <!-- <span><?php echo e($category->getCategoryCount()); ?> <?php echo app('translator')->get('Listings'); ?></span> -->
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="listing-not-found">
                        <h5 class="text-center m-0"><?php echo app('translator')->get("No Data Found"); ?></h5>
                        <p class="text-center not-found-times">
                            <i class="fad fa-file-times not-found-times"></i>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <div class="listing-not-found">
        <h5 class="text-center m-0"><?php echo app('translator')->get("No Data Found"); ?></h5>
        <p class="text-center not-found-times">
            <i class="fad fa-file-times not-found-times"></i>
        </p>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $(document).ready(function(){
            $('.character').on('click', function(){
                let character = $(this).attr('data-character');
                let _this = this;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('categorySearch')); ?>",
                    type: "post",
                    data: {
                        character: character,
                    },
                    success: function(data) {
                        $('.owl-item').removeClass('active');
                        $('.character').not(this).removeClass('active');
                        $(_this).addClass('active');
                        if ((data.count) * 1 < 1) {
                            $('#renderCategory').html(`<div class="custom-not-found2">
                                <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>"
                                     class="img-fluid">
                            </div>`);
                        } else {
                            $('#renderCategory').html(data.data);
                            $(this).addClass('active');
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/category.blade.php ENDPATH**/ ?>