<!DOCTYPE html>
<html class="no-js" lang="en" <?php if(session()->get('rtl') == 1): ?> dir="rtl" <?php endif; ?> >
    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <!-- bootstrap 5 -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/bootstrap5.min.css')); ?>" />
        <!-- font awesome 5 -->
        <script src="<?php echo e(asset('assets/global/js/fontawesomepro.js')); ?>"></script>
        <!-- custom css -->
        <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/style.css')); ?>" />
    </head>
    <body>

        <?php echo $__env->make($theme.'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make($theme.'partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <!-- bootstrap -->
        <script src="<?php echo e(asset($themeTrue.'js/bootstrap.bundle.min.js')); ?>"></script>
        <!-- jquery cdn -->
        <script src="<?php echo e(asset('assets/global/js/jquery.min.js')); ?>"></script>

        <!-- custom script -->
        <script src="<?php echo e(asset($themeTrue.'js/script.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/layouts/error.blade.php ENDPATH**/ ?>