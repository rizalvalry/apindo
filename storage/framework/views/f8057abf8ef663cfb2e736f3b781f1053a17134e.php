<div>
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

    <div id="thumbCarousel" class="carousel max-w-xl mx-auto mb-3 thumb_carousel">
        <?php $__empty_1 = true; $__currentLoopData = $single_listing_details->get_listing_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="carousel__slide">
                <img class="panzoom__content img-fluid" src="<?php echo e(getFile($listing_image->driver, $listing_image->listing_image)); ?>"/>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>
    </div>
</div>

<div class="row align-items-center">
    <?php if(count($single_listing_details->get_social_info) > 0): ?>
        <div class="col-8">
            <div id="">
                <?php $__currentLoopData = $single_listing_details->get_social_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="btn btn-light" href="<?php echo e($social->social_url); ?>" target="_blank" title=""><i class="<?php echo e($social->social_icon); ?> fa-2x" aria-hidden="true"></i></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-4">
        <div class="d-flex justify-content-end">

            <button class="share">
                <div id="shareBlock2"></div>
                <i class="fal fa-share-alt" aria-hidden="true"></i>
            </button>
            <button type="button" class="view-btn">
                <i class="far fa-eye"></i><span class="badge text-white"><?php echo e($total_listing_view); ?></span>
            </button>
        </div>
    </div>
</div>

<div class="info-box mb-5">
    <h4 class="title"><?php echo e($single_listing_details->title); ?></h4>
    <p class="p-0"><?php echo app('translator')->get('Category'); ?>: <?php echo e($single_listing_details->getCategoriesName()); ?> </p>
    <?php if($single_listing_details->address): ?>
        <p class="address mb-2">
            <i class="fas fa-map-marker-alt"></i>
            <?php echo e($single_listing_details->address); ?>

        </p>
    <?php endif; ?>
    <?php if($single_listing_details->get_user->website): ?>
        <p> <i class="fal fa-globe me-1 text-primary"></i> <a href="javascript:void(0)" ><span> <?php echo app('translator')->get(optional($single_listing_details->get_user)->website); ?></span> </a></p>
    <?php endif; ?>
</div>


<?php $__env->startPush('script'); ?>
    <script>
        $("#shareBlock2").socialSharingPlugin({
            urlShare: window.location.href,
            description: $("meta[name=description]").attr("content"),
            title: $("title").text(),
        });
    </script>
<?php $__env->stopPush(); ?>;


<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/xzoom_container.blade.php ENDPATH**/ ?>