<?php if(count($allListingsAndCategory) > 0): ?>
    <section class="category-section">
        <div class="container">
            <div class="row g-3 g-lg-4">
                <?php $__currentLoopData = $allListingsAndCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-md-6 col-6">
                        <a href="<?php echo e(route('listing', [slug(optional($category->details)->name), $category->id])); ?>">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/categorylist.blade.php ENDPATH**/ ?>