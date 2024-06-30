

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Edit Place'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <!-- leaflet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/esri-leaflet-geocoder.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet-search.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/Control.FullScreen.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet-search-two.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="<?php echo e(route('admin.place')); ?>" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back'); ?></span>
                </a>
            </div>




            <div class="tab-content mt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="lang-tab1" role="tabpanel">
                            <form method="post" action="<?php echo e(route('admin.placeUpdate', $id)); ?>" class="mt-4" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="map-box">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="place"> <?php echo app('translator')->get('Search Place'); ?> </label>
                                                    <input
                                                    id="address-search"
                                                    class="form-control <?php $__errorArgs = ['place'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="place"
                                                    value="<?php echo e(old('place', $placeDetails->place)); ?>"
                                                    type="text"
                                                    placeholder="<?php echo app('translator')->get('Search Location'); ?>"
                                                    autocomplete="off"
                                                    />
                                                    <div class="invalid-feedback">
                                                        <?php $__errorArgs = ['place'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="lat"> <?php echo app('translator')->get('Latitude '); ?> </label>
                                                    <input
                                                        class="form-control <?php $__errorArgs = ['lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="lat"
                                                        name="lat"
                                                        type="text"
                                                        value="<?php echo e(old('lat', optional($placeDetails->places)->lat)); ?>"
                                                        placeholder="<?php echo app('translator')->get('Latitude'); ?>"
                                                    />
                                                    <div class="invalid-feedback">
                                                        <?php $__errorArgs = ['lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="long"> <?php echo app('translator')->get('Longitude '); ?> </label>
                                                    <input
                                                        class="form-control <?php $__errorArgs = ['long'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="lng"
                                                        name="long"
                                                        value="<?php echo e(old('long', optional($placeDetails->places)->long)); ?>"
                                                        placeholder="<?php echo app('translator')->get('Longitude'); ?>"
                                                        type="text"
                                                    />
                                                    <div class="invalid-feedback">
                                                        <?php $__errorArgs = ['long'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="valid-feedback"></div>
                                                </div>

                                                <div class="input-box col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <label><?php echo app('translator')->get('Status'); ?></label>
                                                        <div class="custom-switch-btn">
                                                            <input type='hidden' value='1' name='status'>
                                                            <input type="checkbox" name="status" class="custom-switch-checkbox"
                                                                id="status"
                                                                value="0" <?php if( optional($placeDetails->places)->status == 0):echo 'checked'; endif ?>>
                                                            <label class="custom-switch-checkbox-label" for="status">
                                                                <span class="custom-switch-checkbox-inner"></span>
                                                                <span class="custom-switch-checkbox-switch"></span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div id="map">
                                                <p>
                                                <?php echo app('translator')->get('You can also set location moving
                                                marker'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><?php echo app('translator')->get('Save'); ?></button>
                            </form>
                    </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- leaflet -->
    <script src="<?php echo e(asset('assets/global/js/leaflet.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/Control.FullScreen.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/esri-leaflet.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/leaflet-search.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/global/js/esri-leaflet-geocoder.js')); ?>"></script>
    <script src="<?php echo e(asset($themeTrue.'js/bootstrap-geocoder.js')); ?>"></script>
    <!-- Map script -->
    <script src="<?php echo e(asset('assets/global/js/map.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.min.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/summernote.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/place/edit.blade.php ENDPATH**/ ?>