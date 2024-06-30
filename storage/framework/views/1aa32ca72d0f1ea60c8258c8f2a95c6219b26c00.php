
<?php $__env->startSection('title','419'); ?>
<?php $__env->startSection('content'); ?>
    <section id="add-recipient-form" class="wow fadeInUp section__padding" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 text-center">
                    <span class="display-1 d-block"><?php echo app('translator')->get('419'); ?></span>
                    <div class="mb-4 lead"><?php echo app('translator')->get("Sorry, your session has expired"); ?></div>
                    <a class="btn btn-primary btn-custom text-white" href="<?php echo e(url('/')); ?>" ><?php echo app('translator')->get('Back To Home'); ?></a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/errors/419.blade.php ENDPATH**/ ?>