    <!DOCTYPE html>
    <html class="no-js" lang="en" <?php if(session()->get('rtl') == 1): ?> dir="rtl" <?php endif; ?> >
    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <?php if(in_array(request()->route()->getName(),['listing-details'])): ?>
            <?php echo $__env->yieldPushContent('seo'); ?>
        <?php else: ?>
            <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <title><?php echo $__env->yieldContent('title'); ?></title>
        <!-- bootstrap 5 -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/bootstrap5.min.css')); ?>"/>
        <!-- Header Head -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/header-head.css')); ?>"/>
        <!-- select 2 -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>"/>
        <!-- owl carousel -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/animate.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.carousel.min.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/owl.theme.default.min.css')); ?>"/>
        <!-- range slider -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/range-slider.css')); ?>"/>
        <!-- magnific popup -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/magnific-popup.css')); ?>"/>
        <!-- font awesome 5 -->
        <script src="<?php echo e(asset('assets/global/js/fontawesomepro.js')); ?>"></script>
        <!-- fancybox slider -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/fancybox.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap-icons.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrapicons-iconpicker.css')); ?>">
        <!-- custom css -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/style.css')); ?>"/>
        <?php echo $__env->yieldPushContent('css-lib'); ?>
        <!----  Push your custom css  ----->
        <?php echo $__env->yieldPushContent('style'); ?>
    </head>
    <body <?php if(session()->get('rtl') == 1): ?> class="rtl" <?php endif; ?> >
    <?php echo $__env->make($theme.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make($theme.'partials.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="popupModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="popupModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="popupModal"><?php echo app('translator')->get('Haloo'); ?>
                    </h4>
                    
                </div> -->
                <div class="modal-body" style="padding:0px !important">
                <img src="<?php echo e(asset('assets/admin/images/show-banner-popup.jpeg')); ?>"
                            class="w-100" alt="<?php echo e(config('basic.site_title')); ?>">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make($theme.'partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('whatsapp_chat'); ?>
    <?php echo $__env->yieldPushContent('fb_messenger_chat'); ?>

    <?php echo $__env->make($theme.'partials.cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('extra-content'); ?>

    <?php echo $__env->yieldPushContent('frontend_modal'); ?>

    <!-- bootstrap -->
    <script src="<?php echo e(asset($themeTrue.'js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- jquery cdn -->
    <script src="<?php echo e(asset('assets/global/js/jquery.min.js')); ?>"></script>

    <!-- Header JS -->
    <script src="<?php echo e(asset('assets/global/js/header-head.js')); ?>"></script>


    <!-- select 2 -->
    <script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>
    <!-- owl carousel -->
    <script src="<?php echo e(asset($themeTrue.'js/owl.carousel.min.js')); ?>"></script>
    <!-- range slider -->
    <script src="<?php echo e(asset($themeTrue.'js/range-slider.min.js')); ?>"></script>
    <!-- leaflet js -->
    <script src="<?php echo e(asset('assets/global/js/leaflet.js')); ?>"></script>
    <!-- social share -->
    <script src="<?php echo e(asset($themeTrue.'js/socialSharing.js')); ?>"></script>
    <!-- magnific popup -->
    <script src="<?php echo e(asset($themeTrue.'js/magnific-popup.js')); ?>"></script>


    <?php echo $__env->yieldPushContent('extra-js'); ?>


    <script src="<?php echo e(asset('assets/global/js/notiflix-aio-2.7.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/pusher.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/vue.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/axios.min.js')); ?>"></script>

    <script src="<?php echo e(asset($themeTrue.'js/script.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>

    <script>
        $(document).ready(function() {
            <?php if(Route::currentRouteName() == 'home'): ?>
            $('#popupModal').modal('show');
        <?php endif; ?>
        });
    </script>

    <?php echo $__env->make($theme.'partials.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>


    <?php echo $__env->make('plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
    </html>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/layouts/app.blade.php ENDPATH**/ ?>