
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Claim List"); ?>
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
                <form action="" method="get" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="name"> <?php echo app('translator')->get('Listing'); ?></label>
                                <input type="text" name="name" value="<?php echo e(old('name', request()->name)); ?>" class="form-control"
                                       placeholder="<?php echo app('translator')->get('Search Listing..'); ?>">
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="from_date"> <?php echo app('translator')->get('From Date'); ?></label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="<?php echo app('translator')->get('From date'); ?>" value="<?php echo e(old('from_date', request()->from_date)); ?>"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="to_date"> <?php echo app('translator')->get('To Date'); ?></label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="<?php echo app('translator')->get('To date'); ?>" value="<?php echo e(old('to_date', request()->to_date)); ?>" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn w-100 w-md-auto btn-primary listing-btn-search-custom mt-2"><i
                                        class="fas fa-search"></i> <?php echo app('translator')->get('Search'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('#'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Owner'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Listing'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Claim'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Date-Time'); ?></th>
                        <?php if(adminAccessRoute(config('role.claim_business.access.view')) == true || adminAccessRoute(config('role.claim_business.access.delete')) == true): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $allClaims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>"><?php echo e(loopIndex($allClaims) + $loop->index); ?></td>

                            <td data-label="<?php echo app('translator')->get('Owner'); ?>">
                                <div class="float-left">
                                    <a href="<?php echo e(route('admin.user-edit', optional(optional($claim->get_listing)->get_user)->id)); ?>" target="_blank">
                                        <img src="<?php echo e(getFile(optional(optional($claim->get_listing)->get_user)->driver, optional(optional($claim->get_listing)->get_user)->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get(optional(optional($claim->get_listing)->get_user)->firstname); ?> <?php echo app('translator')->get(optional(optional($claim->get_listing)->get_user)->lastname); ?> <br>
                                    <?php echo app('translator')->get(optional(optional($claim->get_listing)->get_user)->email); ?>
                                </div>
                            </td>
                            <?php
                                $owner = optional(optional($claim->get_listing)->get_user)->firstname . ' ' . optional(optional($claim->get_listing)->get_user)->lastname;
                            ?>

                            <td data-label="<?php echo app('translator')->get('Listing'); ?>">
                                <a href="<?php echo e(route('admin.viewListings', [slug(optional($claim->get_listing)->title), $claim->listing_id])); ?>">
                                    <?php echo app('translator')->get(optional($claim->get_listing)->title); ?>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Claim'); ?>">
                                <div class="float-left">
                                    <a href="<?php echo e(route('admin.user-edit', optional($claim->get_client)->id)); ?>" target="_blank">
                                        <img src="<?php echo e(getFile(optional($claim->get_client)->driver, optional($claim->get_client)->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get(optional($claim->get_client)->firstname); ?> <?php echo app('translator')->get(optional($claim->get_client)->lastname); ?> <br>
                                    <?php echo app('translator')->get(optional($claim->get_client)->email); ?>
                                </div>
                            </td>
                            <?php
                                $claim_client = optional($claim->get_client)->firstname . ' ' . optional($claim->get_client)->lastname;
                            ?>

                            <td data-label="<?php echo app('translator')->get('Date-Time'); ?>"><?php echo e(dateTime($claim->created_at)); ?></td>
                            <?php if(adminAccessRoute(config('role.claim_business.access.view')) == true || adminAccessRoute(config('role.claim_business.access.delete')) == true): ?>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded btn-icon edit_button notiflix-confirm showClaimMessage"
                                            data-toggle="modal" data-target="#myModal" data-from="<?php echo e($owner); ?>" data-to="<?php echo e($claim_client); ?>" data-message="<?php echo e($claim->message); ?>" data-time="<?php echo e(dateTime($claim->created_at)); ?>">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <a href="<?php echo e(route('admin.viewListings', [slug(optional($claim->get_listing)->title), optional($claim->get_listing)->id])); ?>" class="btn btn-sm btn-outline-primary rounded btn-icon edit_button">
                                        <i class="fa fa-location-arrow"></i>
                                    </a>

                                    <?php if(adminAccessRoute(config('role.claim_business.access.delete')) == true): ?>
                                        <button type="button" class="btn btn-outline-danger rounded btn-sm btn-icon edit_button notiflix-confirm"
                                                data-toggle="modal" data-target="#delete-modal"
                                                data-route="<?php echo e(route('admin.claimMessageDelete',$claim->id)); ?>">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center text-danger" colspan="9"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($allClaims->appends($_GET)->links('partials.pagination')); ?>

            </div>
        </div>
    </div>

    <?php $__env->startPush('adminModal'); ?>
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

        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('Claim Business Information'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item messageFrom"></li>
                                <li class="list-group-item messageTo"></li>
                                <li class="list-group-item contactMessage"></li>
                                <li class="list-group-item contactDateTime"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        'use strict'
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled')
        });
    </script>

    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.showClaimMessage', function () {
                var showMessageModal = new bootstrap.Modal(document.getElementById('messageModal'))
                showMessageModal.show()

                let from = $(this).data('from');
                let to = $(this).data('to');
                let message = $(this).data('message');
                let dateTime = $(this).data('time');

                $('.messageFrom').text(`<?php echo app('translator')->get('Listing Owner: '); ?> ${from}`);
                $('.messageTo').text(`<?php echo app('translator')->get('Claim: '); ?> ${to}`);
                $('.contactMessage').text(`<?php echo app('translator')->get('Claim Message: '); ?> ${message}`);
                $('.contactDateTime').text(`<?php echo app('translator')->get('Date-Time: '); ?> ${dateTime}`);

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/claim/claimList.blade.php ENDPATH**/ ?>