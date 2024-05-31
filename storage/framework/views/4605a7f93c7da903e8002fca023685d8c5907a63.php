<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Edit Package'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="<?php echo e(route('admin.package')); ?>" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back'); ?></span>
                </a>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" data-toggle="tab" href="#lang-tab-<?php echo e($key); ?>" role="tab" aria-controls="lang-tab-<?php echo e($key); ?>"
                           aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>"><?php echo app('translator')->get($language->name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="tab-content mt-2" id="myTabContent">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="lang-tab-<?php echo e($key); ?>" role="tabpanel">
                    <form method="post" action="<?php echo e(route('admin.packageUpdate',[$id, $language->id])); ?>" class="mt-4" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3 package_title">
                                <label for="name"> <?php echo app('translator')->get('Package title'); ?> </label>
                                <input type="text" name="title[<?php echo e($language->id); ?>]"
                                        class="form-control  <?php $__errorArgs = ['title'.'.'.$language->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo old('title'.$language->id, isset($packageDetails[$language->id]) ? $packageDetails[$language->id][0]->title : '') ?>">
                                <div class="invalid-feedback">
                                    <?php $__errorArgs = ['title'.'.'.$language->id];
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

                            <?php if($loop->index == 0): ?>
                                <div class="col-lg-4 col-md-4 form-group col-sm-12 col-12 package_price_div">
                                    <label> <?php echo e(trans('Price')); ?></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="price" value="<?php echo e(old('price', optional($packageDetails[$language->id][0]->package)->price)); ?>"
                                               class="form-control  <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> package_price"
                                               aria-describedby="basic-addon2" id="package_price">
                                        <div class="input-group-append">
                                                <span class="input-group-text package_price_symbol"
                                                      id="basic-addon2"> <?php echo e($basic->currency_symbol ?? '$'); ?>

                                                </span>
                                            <span class="input-group-text" id="basic-addon2"> <span
                                                    class="mr-2"><?php echo app('translator')->get('Free'); ?></span>
                                                <input type="checkbox" name="is_free" value="-1"
                                                       id="free_package"
                                                       class="free_package" <?php echo e(old('is_free') == -1 || optional($packageDetails[$language->id][0]->package)->price  == null ? 'checked' : ''); ?>></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['price'];
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12 is_multiple_time_purchase">
                                    <label> <?php echo e(trans('Allow Multiple Time Purchase')); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name="is_multiple_time_purchase" <?php echo e(old('is_multiple_time_purchase', optional($packageDetails[$language->id][0]->package)->is_multiple_time_purchase) == "1" ? 'checked' : ''); ?>>
                                        <input type="checkbox" name="is_multiple_time_purchase" id="is_multiple_time_purchase" class="custom-switch-checkbox" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_multiple_time_purchase == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_multiple_time_purchase">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3 package_expiry">
                                    <label> <?php echo e(trans('Package Expiry')); ?> </label>
                                    <div class="input-group">
                                        <input type="text" name="expiry_time" class="form-control expiry_time <?php $__errorArgs = ['expiry_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('expiry_time', optional($packageDetails[$language->id][0]->package)->expiry_time)); ?>" <?php echo e(old('expiry_time', optional($packageDetails[$language->id][0]->package)->expiry_time) == null ? 'disabled' : ''); ?>>

                                        <div class="input-group-append">
                                            <select class="form-control expiry_time_type" id="expiry_time_type" name="expiry_time_type" <?php echo e(old('expiry_time_type', optional($packageDetails[$language->id][0]->package)->expiry_time) == null ? 'disabled' : ''); ?>>
                                                <option value="Days" <?php echo e($packageDetails[$language->id][0]->package->expiry_time_type == 'Days' || optional($packageDetails[$language->id][0]->package)->expiry_time_type == 'Day' ? 'selected' : ''); ?>><?php echo app('translator')->get('Day(s)'); ?></option>
                                                <option value="Months" <?php echo e(optional($packageDetails[$language->id][0]->package)->expiry_time_type == 'Months' || optional($packageDetails[$language->id][0]->package)->expiry_time_type == 'Month' ? 'selected' : ''); ?>><?php echo app('translator')->get('Month(s)'); ?></option>
                                                <option value="Years" <?php echo e(optional($packageDetails[$language->id][0]->package)->expiry_time_type == 'Year' || optional($packageDetails[$language->id][0]->package)->expiry_time_type == 'Years' ? 'selected' : ''); ?>><?php echo app('translator')->get('Year(s)'); ?></option>
                                            </select>

                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="expiry_time_unlimited" value="-1" id="expiry_time_unlimited" class="expiry_time_unlimited" <?php echo e(old('expiry_time_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->expiry_time == null ? 'checked' : ''); ?>></span>
                                        </div>

                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['expiry_time'];
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
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($loop->index == 0): ?>
                            <div class="row mb-3">

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Image'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name="is_image">
                                        <input type="checkbox" name="is_image" id="is_image" class="custom-switch-checkbox image_no" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_image == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_image">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Video'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name="is_video">
                                        <input type="checkbox" name="is_video" id="is_video" class="custom-switch-checkbox video_no" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_video == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_video">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Amenities'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name="is_amenities">
                                        <input type="checkbox" name="is_amenities" id="is_amenities" class="custom-switch-checkbox amenities_no" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_amenities == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_amenities">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Product'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name="is_product">
                                        <input type="checkbox" name="is_product" id="is_product" class="custom-switch-checkbox product_no" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_product == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_product">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Business Hour'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='is_business_hour'>
                                        <input type="checkbox" name="is_business_hour" id="is_business_hour" class="custom-switch-checkbox" value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_business_hour == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_business_hour">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('SEO'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='seo'>
                                        <input type="checkbox" name="seo" class="custom-switch-checkbox"
                                                id="seo"
                                                value="0" <?php if( optional($packageDetails[$language->id][0]->package)->seo == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="seo">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Messenger Chat'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='is_messenger'>
                                        <input type="checkbox" name="is_messenger" class="custom-switch-checkbox"
                                               id="is_messenger"
                                               value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_messenger == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_messenger">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                                    <label><?php echo app('translator')->get('Whats App Chat'); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='is_whatsapp'>
                                        <input type="checkbox" name="is_whatsapp" class="custom-switch-checkbox"
                                               id="is_whatsapp"
                                               value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_whatsapp == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_whatsapp">
                                            <span class="custom-switch-checkbox-for-package"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if($loop->index == 0): ?>
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label> <?php echo e(trans('No. of listing')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="1" name="no_of_listing"  class="no_of_listing form-control <?php $__errorArgs = ['no_of_listing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invali <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-describedby="basic-addon2" value="<?php echo e(old('no_of_listing', optional($packageDetails[$language->id][0]->package)->no_of_listing)); ?>" <?php echo e(old('no_of_listing', optional($packageDetails[$language->id][0]->package)->no_of_listing) == null ? 'disabled' : ''); ?>>

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="no_of_listing_unlimited" value="-1" id="listing_unlimited" class="listing_unlimited" <?php echo e(old('listing_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_listing  == null ? 'checked' : ''); ?>></span>
                                        </div>

                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_listing'];
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label> <?php echo e(trans('No. of images per listing')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="no_of_img_per_listing" min="1" value="<?php echo e(old('no_of_img_per_listing', optional($packageDetails[$language->id][0]->package)->no_of_img_per_listing)); ?>" class="form-control no_of_img_per_listing <?php $__errorArgs = ['no_of_img_per_listing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-describedby="basic-addon2" <?php echo e(old('is_image', optional($packageDetails[$language->id][0]->package)->is_image) == 0 || old('listing_img_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_img_per_listing == null ? 'disabled' : ''); ?> >

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="no_of_img_per_listing_unlimited" value="-1" id="listing_img_unlimited" class="listing_img_unlimited" <?php echo e(old('is_image', optional($packageDetails[$language->id][0]->package)->is_image) == 1 && (old('listing_img_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_img_per_listing == null) ? 'checked' : ''); ?>></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_img_per_listing'];
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-12">
                                    <label> <?php echo e(trans('No. of categories per listing')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="no_of_categories_per_listing"
                                               value="<?php echo e(old('no_of_categories_per_listing', optional($packageDetails[$language->id][0]->package)->no_of_categories_per_listing)); ?>" min="1"
                                               class="form-control no_of_categories_per_listing <?php $__errorArgs = ['no_of_categories_per_listing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               aria-describedby="basic-addon2">
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_categories_per_listing'];
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

                                <div class="form-group col-lg-3 col-md-3 col-12">
                                    <label> <?php echo e(trans('No. of amenities per listing')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="no_of_amenities_per_listing" value="<?php echo e(old('no_of_amenities_per_listing', optional($packageDetails[$language->id][0]->package)->no_of_amenities_per_listing)); ?>" min="1" class="form-control no_of_amenities_per_listing <?php $__errorArgs = ['no_of_amenities_per_listing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-describedby="basic-addon2" <?php echo e(old('is_amenities', optional($packageDetails[$language->id][0]->package)->is_amenities) == 0 || old('amenities_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_amenities_per_listing == null ? 'disabled' : ''); ?>>

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="no_of_amenities_per_listing_unlimited" value="-1" id="amenities_unlimited" class="amenities_unlimited" <?php echo e(old('is_amenities', optional($packageDetails[$language->id][0]->package)->is_amenities) == 1 && (old('amenities_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_amenities_per_listing == null) ? 'checked' : ''); ?>></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_amenities_per_listing'];
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
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label> <?php echo e(trans('No. of product')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="no_of_product" min="1"  class="no_of_product form-control <?php $__errorArgs = ['no_of_product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-describedby="basic-addon2" value="<?php echo e(old('no_of_product', optional($packageDetails[$language->id][0]->package)->no_of_product)); ?>" <?php echo e(old('is_product', optional($packageDetails[$language->id][0]->package)->is_product) == 0 || old('product_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_product == null ? 'disabled' : ''); ?>>


                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="no_of_product_unlimited" value="-1" id="product_unlimited" class="product_unlimited" <?php echo e(old('is_product', optional($packageDetails[$language->id][0]->package)->is_product) == 1 && (old('product_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_product == null) ? 'checked' : ''); ?>></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_product'];
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label> <?php echo e(trans('No. of images per product')); ?> </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="no_of_img_per_product" value="<?php echo e(old('no_of_img_per_product', optional($packageDetails[$language->id][0]->package)->no_of_img_per_product)); ?>" min="1" class="form-control no_of_img_per_product <?php $__errorArgs = ['no_of_img_per_product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" aria-describedby="basic-addon2" <?php echo e(old('is_product', optional($packageDetails[$language->id][0]->package)->is_product) == 0 || old('product_img_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_img_per_product == null ? 'disabled' : ''); ?>>

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"> <span class="mr-2"><?php echo app('translator')->get('Unlimited'); ?></span> <input type="checkbox" name="no_of_img_per_product_unlimited" value="-1" id="product_img_unlimited" class="product_img_unlimited" <?php echo e(old('is_product', optional($packageDetails[$language->id][0]->package)->is_product) == 1 && (old('product_img_unlimited') == -1 || optional($packageDetails[$language->id][0]->package)->no_of_img_per_product == null) ? 'checked' : ''); ?>></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php $__errorArgs = ['no_of_img_per_product'];
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
                                </div>

                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label> <?php echo e(trans('Renew Package')); ?></label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' class="is_renew" name='is_renew' <?php echo e(old('is_renew', optional($packageDetails[$language->id][0]->package)->is_renew) == "1" ? 'checked' : ''); ?>>
                                        <input type="checkbox" name="is_renew" class="custom-switch-checkbox is_renew"
                                               id="is_renew"
                                               value="0" <?php if( optional($packageDetails[$language->id][0]->package)->is_renew == 0):echo 'checked'; endif ?>>
                                        <label class="custom-switch-checkbox-label" for="is_renew">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="form-group ">
                                        <label><?php echo app('translator')->get('Status'); ?></label>
                                        <div class="custom-switch-btn">
                                            <input type='hidden' value='1' name='status'>
                                            <input type="checkbox" name="status" class="custom-switch-checkbox" id="status"
                                                   value="0" <?php if( optional($packageDetails[$language->id][0]->package)->status == 0):echo 'checked'; endif ?>>
                                            <label class="custom-switch-checkbox-label" for="status">
                                                <span class="custom-switch-checkbox-inner"></span>
                                                <span class="custom-switch-checkbox-switch"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-4 col-6">
                                    <div class="form-group">
                                        <label for="image"><?php echo e(('Image')); ?></label>
                                        <div class="image-input ">
                                            <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                            <input type="file" name="image" placeholder="<?php echo app('translator')->get('Choose image'); ?>" id="image">
                                            <img id="image_preview_container" class="preview-image"
                                                 src="<?php echo e(getFile(optional($packageDetails[$language->id][0]->package)->driver,optional($packageDetails[$language->id][0]->package)->image)); ?>"
                                                alt="<?php echo app('translator')->get('preview image'); ?>">
                                        </div>
                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><?php echo app('translator')->get('Save'); ?></button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/summernote.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script defer>
        'use strict'
        $(document).ready(function () {

            $(document).on('click', '.expiry_time_unlimited', function (){
                if ($('.expiry_time_unlimited').is(':checked')){
                    $('.is_renew').attr('disabled', 'disabled');
                    $('.is_renew').prop('checked', true);
                }
                else {
                    $('.is_renew').removeAttr('disabled');
                    $('.is_renew').prop('checked', false);
                }
            })

            if ($('.free_package').is(':checked')){
                $('.package_price_symbol').text('');
                $('.is_multiple_time_purchase').removeClass('d-none');
                $('.package_title').removeClass('col-lg-4 col-md-4');
                $('.package_title').addClass('col-lg-3 col-md-3');
                $('.package_price_div').removeClass('col-lg-4 col-md-4');
                $('.package_price_div').addClass('col-lg-3 col-md-3');
                $('.package_expiry').removeClass('col-lg-4 col-md-4');
                $('.package_expiry').addClass('col-lg-3 col-md-3');
            }
            else {
                $('.package_price_symbol').text('$');
                $('.is_multiple_time_purchase').addClass('d-none');
                $('.package_title').addClass('col-lg-4 col-md-4');
                $('.package_title').removeClass('col-lg-3 col-md-3');
                $('.package_price_div').addClass('col-lg-4 col-md-4');
                $('.package_price_div').removeClass('col-lg-3 col-md-3');
                $('.package_expiry').addClass('col-lg-4 col-md-4');
                $('.package_expiry').removeClass('col-lg-3 col-md-3');
            }

            $(document).on('click', '.free_package', function (){
                if ($('.free_package').is(':checked')){
                    $('.package_price_symbol').text('');
                    $('.is_multiple_time_purchase').removeClass('d-none');
                    $('.package_title').removeClass('col-lg-4 col-md-4');
                    $('.package_title').addClass('col-lg-3 col-md-3');
                    $('.package_price_div').removeClass('col-lg-4 col-md-4');
                    $('.package_price_div').addClass('col-lg-3 col-md-3');
                    $('.package_expiry').removeClass('col-lg-4 col-md-4');
                    $('.package_expiry').addClass('col-lg-3 col-md-3');
                }
                else {
                    $('.package_price_symbol').text('$');
                    $('.is_multiple_time_purchase').addClass('d-none');
                    $('.package_title').addClass('col-lg-4 col-md-4');
                    $('.package_title').removeClass('col-lg-3 col-md-3');
                    $('.package_price_div').addClass('col-lg-4 col-md-4');
                    $('.package_price_div').removeClass('col-lg-3 col-md-3');
                    $('.package_expiry').addClass('col-lg-4 col-md-4');
                    $('.package_expiry').removeClass('col-lg-3 col-md-3');
                }
            })

            let selectors = {
                'input[name="expiry_time_unlimited"]': {
                    disabled: ['.expiry_time', '.expiry_time_type'],
                    blank: ['.expiry_time'],
                    except: ''
                },
                'input[name="is_product"]': {
                    disabled: ['.no_of_product', '.product_unlimited', '.no_of_img_per_product', '.product_img_unlimited'],
                    blank: ['.no_of_product', '.no_of_img_per_product'],
                    except: ''
                },
                'input[name="is_image"]': {
                    disabled: ['.no_of_img_per_listing', '.listing_img_unlimited'],
                    blank: ['.no_of_img_per_listing'],
                    except: ''
                },
                'input[name="is_amenities"]': {
                    disabled: ['.no_of_amenities_per_listing', '.amenities_unlimited'],
                    blank: ['.no_of_amenities_per_listing'],
                    except: ''
                },
                'input[name="no_of_listing_unlimited"]': {
                    disabled: ['.no_of_listing'],
                    blank: ['.no_of_listing'],
                    except: ''
                },
                'input[name="is_free"]': {
                    disabled: ['.package_price'],
                    blank: ['.package_price'],
                    except: ''
                },
                'input[name="no_of_img_per_listing_unlimited"]': {
                    disabled: ['.no_of_img_per_listing'],
                    blank: ['.no_of_img_per_listing'],
                    except: '.image_no'
                },
                'input[name="no_of_img_per_product_unlimited"]': {
                    disabled: ['.no_of_img_per_product'],
                    blank: ['.no_of_img_per_product'],
                    except: '.product_no'
                },
                'input[name="no_of_amenities_per_listing_unlimited"]': {
                    disabled: ['.no_of_amenities_per_listing'],
                    blank: ['.no_of_amenities_per_listing'],
                    except: '.amenities_no'
                },
                'input[name="no_of_product_unlimited"]': {
                    disabled: ['.no_of_product'],
                    blank: ['.no_of_product'],
                    except: '.product_no'
                }
            }

            for (let selector in selectors) {
                setEnableDisable(selectors[selector], $(`${selector}:checked`));

                $(document).on('click', selector, function () {
                    setEnableDisable(selectors[selector], this);
                });
            }

            function setEnableDisable(selectors, parentSelector) {
                let disable = false;
                if (($(parentSelector).val() == 0 || $(parentSelector).val() == -1) && $(parentSelector).is(":checked")) {
                    disable = true;
                }

                let disabledSelector = selectors.disabled.toString();
                let blankSelector = selectors.blank.toString();

                if (disable) {
                    $(disabledSelector).attr('disabled', 'disabled');
                    $(blankSelector).val('');
                } else if (!selectors.except || !$(selectors.except).is(":checked")) {
                    $(disabledSelector).removeAttr('disabled');
                }
            }

            $('#image').change("on",function () {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image_preview_container').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('.summernote').summernote({
                    height: 250,
                    callbacks: {
                        onBlurCodeview: function() {
                            let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                            $(this).val(codeviewHtml);
                        }
                    }
                });
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/package/edit.blade.php ENDPATH**/ ?>