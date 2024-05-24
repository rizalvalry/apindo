<!-- blog section -->
<?php if(count($popularBlogs) > 0): ?>
    <section class="blog-section">
        <div class="container">
            <?php if(isset($templates['blog'][0]) && $blog = $templates['blog'][0]): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center mb-5">
                            <h5><?php echo app('translator')->get(optional($blog->description)->title); ?></h5>
                            <h3><?php echo app('translator')->get(optional($blog->description)->sub_title); ?></h3>
                            <p class="mx-auto">
                                <?php echo app('translator')->get(optional($blog->description)->short_title); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row gy-3 g-md-5">
                <?php $__currentLoopData = $popularBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-box">
                            <div class="img-box">
                                <img class="img-fluid" src="<?php echo e(getFile($blog->driver, $blog->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>"/>
                            </div>
                            <div class="text-box">
                                <span class="category"><?php echo app('translator')->get(optional(optional($blog->blogCategory)->details)->name); ?></span>
                                <a href="<?php echo e(route('blogDetails',[slug(optional($blog->details)->title), $blog->id])); ?>" class="title"
                                ><?php echo e(Str::limit(optional($blog->details)->title, 80)); ?>

                                </a>
                                <div class="date-author">
                                    <span class="author"> <?php echo app('translator')->get(optional($blog->details)->author); ?> </span>
                                    <span class="float-end"><?php echo e(dateTime($blog->created_at, 'M d, Y')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="row text-center mt-5">
                <div class="col">
                    <a href="<?php echo e(route('blog')); ?>" class="btn-custom">
                        <?php echo app('translator')->get('Explore more'); ?>
                        <i class="fal fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/blog.blade.php ENDPATH**/ ?>