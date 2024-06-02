<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Storages"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Storage'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $storages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>"><?php echo e(loopIndex($storages) + $loop->index); ?></td>
                            <td data-label="<?php echo app('translator')->get('Storage'); ?>">
                                <div class="float-left">
                                    <a href="#" target="_blank">
                                        <img src="<?php echo e(getFile($item->driver,config('location.storage.path'). $item->logo )); ?>" alt="<?php echo e(__($item->name)); ?>" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get(($item->name)); ?>
                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <?php if($item->status == 1): ?>
                                    <span class="badge badge-pill bg-success text-white"><?php echo app('translator')->get('Active'); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-pill bg-danger text-white"><?php echo app('translator')->get('Inactive'); ?></span>
                                <?php endif; ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <?php if($item->code == 'local' && $item->status == 1): ?>
                                    <span class="ml-2">--</span>
                                <?php else: ?>
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php if($item->code != 'local'): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('admin.storage.edit',$item->id)); ?>">
                                                    <i class="fas fa-edit"></i>  <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                            <?php endif; ?>

                                            <?php if($item->status != 1): ?>
                                                <a href="javascript:void(0)"
                                                   data-route="<?php echo e(route('admin.storage.setDefault',$item->id)); ?>"
                                                   data-toggle="modal"
                                                   data-target="#set-modal"
                                                   class="notiflix-confirm dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-thumbtack"></i> <?php echo app('translator')->get('Set as default'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center text-danger" colspan="100%"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($storages->links('partials.pagination')); ?>

            </div>
        </div>
    </div>

    <?php $__env->startPush('adminModal'); ?>
        <div id="set-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Confirmation'); ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to set this?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="post" class="setRoute">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?>
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.setRoute').attr('action', route)
            })

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled')
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/storage/index.blade.php ENDPATH**/ ?>