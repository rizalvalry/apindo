<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Package List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <?php if(adminAccessRoute(config('role.manage_package.access.add'))): ?>
                <div class="media mb-4 float-right">
                    <a href="<?php echo e(route('admin.packageCreate')); ?>" class="btn btn-sm btn-primary mr-2">
                        <span><i class="fa fa-plus-circle"></i> <?php echo app('translator')->get('Add New'); ?></span>
                    </a>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('SL No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Package Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Price'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Expiry Time'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_package.access.edit')) == true || adminAccessRoute(config('role.manage_package.access.delete')) == true): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('SL No.'); ?>"><?php echo e($loop->index+1); ?></td>
                            <td data-label="<?php echo app('translator')->get('Package Name'); ?>">
                                <?php echo app('translator')->get(optional($item->details)->title); ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Price'); ?>">
                                <?php if($item->price == null): ?>
                                    <?php echo e($basic->currency_symbol ?? 'USD'); ?>0
                                <?php else: ?>
                                    <?php echo e($basic->currency_symbol ?? 'USD'); ?><?php echo e($item->price); ?>

                                <?php endif; ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Expiry Time'); ?>">
                                <?php if($item->expiry_time == Null): ?>

                                    <span class="badge badge-pill badge-success"><?php echo app('translator')->get('Unlimited'); ?></span>
                                <?php else: ?>
                                    <?php echo e($item->expiry_time); ?> <?php echo app('translator')->get($item->expiry_time_type); ?>
                                <?php endif; ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span class="badge badge-pill <?php echo e($item->status == 1 ? 'badge-success' : 'badge-danger'); ?>"><?php echo app('translator')->get($item->status == 1 ? 'Active' : 'Deactive'); ?></span>
                            </td>
                            <?php if(adminAccessRoute(config('role.manage_package.access.edit')) == true || adminAccessRoute(config('role.manage_package.access.delete')) == true): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <?php if(adminAccessRoute(config('role.manage_package.access.edit')) == true): ?>
                                    <a href="<?php echo e(route('admin.packageEdit',$item->id)); ?>" class="btn btn-outline-primary btn-sm rounded btn-icon edit_button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center" colspan="100%"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header modal-colored-header bg-primary">
                   <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Delete Confirmation'); ?>
                   </h4>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-hidden="true">×
                   </button>
               </div>
               <div class="modal-body">
                   <p><?php echo app('translator')->get('Are you sure to delete this?'); ?></p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-light"
                           data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                   <form action="" method="post" class="deleteRoute">
                       <?php echo csrf_field(); ?>
                       <?php echo method_field('delete'); ?>
                       <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                   </form>
               </div>
           </div>
       </div>
   </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/datatable-basic.init.js')); ?>"></script>

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

    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/package/index.blade.php ENDPATH**/ ?>