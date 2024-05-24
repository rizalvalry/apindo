<?php if(!request()->routeIs('listing-details')): ?>
    <style>
        .banner-section {
            background-image: url(<?php echo e(getFile(config('basic.default_file_driver'),config('basic.partial_banner'))); ?>);
        }
    </style>
<?php else: ?>
    <?php echo $__env->yieldContent('listing_thumbnail'); ?>
<?php endif; ?>

<?php if(!request()->routeIs('home')): ?>
    <section class="banner-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-text text-center">
                            <h3><?php echo $__env->yieldContent('banner_heading'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/banner.blade.php ENDPATH**/ ?>