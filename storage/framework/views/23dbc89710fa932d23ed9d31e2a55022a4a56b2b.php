<?php if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0]): ?>
    <?php $__env->startPush('style'); ?>
        <style>
            #banner-wrap::before {
                background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%), url(<?php echo e(getFile(config('location.content.path').optional($howItWork->templateMedia())->image)); ?>);
            }
        </style>
    <?php $__env->stopPush(); ?>
    <!-- how it works section -->
    <?php if(isset($contentDetails['how-it-work'])): ?>
        <section class="how-it-works">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center mb-5">
                            <h5><?php echo app('translator')->get(optional($howItWork->description)->sub_title); ?></h5>
                            <h3><?php echo app('translator')->get(optional($howItWork->description)->title); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row gy-5 gy-lg-0">
                    <?php $__currentLoopData = $contentDetails['how-it-work']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>  $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-lg-4 col-md-6 mx-auto">
                            <div class="box">
                                <div class="icon-box">
                                    <img src="<?php echo e(getFile(optional(optional($item->content)->contentMedia)->driver, optional(optional(optional($item->content)->contentMedia)->description)->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>" width="64"/>
                                </div>
                                <div>
                                    <h5><?php echo app('translator')->get(optional($item->description)->title); ?></h5>
                                    <p>
                                        <?php echo app('translator')->get(optional($item->description)->short_description); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/how-it-work.blade.php ENDPATH**/ ?>