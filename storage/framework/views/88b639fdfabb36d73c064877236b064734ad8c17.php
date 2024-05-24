<!-- HeroBanner section -->
<?php if(isset($templates['banner-heading'][0]) && $banner_heading = $templates['banner-heading'][0]): ?>
    <?php $__env->startPush('style'); ?>
        <style>
            .home-section {
                background: url(<?php echo e(getFile(optional($banner_heading->media)->driver, $banner_heading->templateMedia()->image)); ?>);
            }
        </style>
    <?php $__env->stopPush(); ?>

    <section class="home-section">
        <div class="overlay h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-12">
                        <div class="text-box text-center">
                            <h1><?php echo app('translator')->get(optional($banner_heading->description)->top_title); ?></h1>
                            <h5 class="text-white">
                                <?php echo app('translator')->get(optional($banner_heading->description)->main_title); ?>
                            </h5>
                            <div class="search-bar">
                                <form action="<?php echo e(route('listing')); ?>" method="get">
                                    <div class="row g-0">
                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                    <i class="fal fa-search"></i>
                                                 </span>
                                                <input type="text" name="name" <?php echo e(old('name', request()->name)); ?>class="form-control" placeholder="<?php echo app('translator')->get('What are you looking for'); ?>?"/>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                  <i class="far fa-chart-scatter"></i>
                                                 </span>
                                                <select class="listing__category__select2 form-control" name="category[]" >
                                                    <option value="all"
                                                            <?php if(request()->category && in_array('all', request()->category)): ?>
                                                                selected
                                                        <?php endif; ?>><?php echo app('translator')->get('All Category'); ?></option>
                                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category->id); ?>"
                                                                <?php if(request()->category && in_array($category->id, request()->category)): ?>
                                                                    selected
                                                            <?php endif; ?>> <?php echo app('translator')->get(optional($category->details)->name); ?>
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                    <i class="fal fa-map-marker-alt"></i>
                                                 </span>
                                                <select class="js-example-basic-single form-control" name="location" autocomplete="off">
                                                    <option value="all" <?php if(request()->location == 'all'): ?> selected <?php endif; ?>><?php echo app('translator')->get('All Locations'); ?></option>
                                                    <?php $__currentLoopData = $all_places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($place->id); ?>" <?php if(request()->location == $place->id): ?> selected <?php endif; ?>><?php echo app('translator')->get(optional($place->details)->place); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <button class="btn-custom w-100 h-100">
                                                <i class="fal fa-search"></i> <?php echo app('translator')->get('search'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'
        $(document).ready(function (){
            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '<?php echo app('translator')->get("Select Categories"); ?>',
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/heroBanner.blade.php ENDPATH**/ ?>