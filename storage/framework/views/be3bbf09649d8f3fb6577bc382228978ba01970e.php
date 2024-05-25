<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Listing Settings"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="<?php echo e(route('admin.listingApprovalStore')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4 col-xl-4 col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="d-block"><?php echo app('translator')->get('Listing Approval'); ?></label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='1' name='listing_approval' <?php echo e(old('listing_approval',$listingApproval->listing_approval) == "1" ? 'checked' : ''); ?>>
                                    <input type="checkbox" name="listing_approval" class="custom-switch-checkbox"
                                           id="listing_approval"
                                           value="0" <?php echo e(old('listing_approval', $listingApproval->listing_approval) == "0" ? 'checked' : ''); ?>>
                                    <label class="custom-switch-checkbox-label" for="listing_approval">
                                        <span class="custom-switch-checkbox-for-package"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="before_expiry_date"> <?php echo app('translator')->get('Package Expiry Notification'); ?></label>
                                <select name="before_expiry_date[]" class="form-control" multiple>
                                        <option disabled><?php echo app('translator')->get('Choose Time'); ?></option>
                                        <option value="30" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '30'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 30 Days'); ?></option>
                                        <option value="15" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '15'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 15 Days'); ?></option>
                                        <option value="10" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '10'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 10 Days'); ?></option>
                                        <option value="7" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '7'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 7 Days'); ?></option>
                                        <option value="3" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '3'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 3 Days'); ?></option>
                                        <option value="1" <?php $__currentLoopData = $packageExpiryCrons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cron): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($cron->before_expiry_date == '1'): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo app('translator')->get('Before 1 Day'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary btn-block  btn-rounded mx-2 mt-4">
                                    <span><?php echo app('translator')->get('Save Changes'); ?></span></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        'use strict'
        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/listing/listingSettings.blade.php ENDPATH**/ ?>