<?php $__env->startSection('title',trans('All Packages')); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap-datepicker.css')); ?>"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0"><?php echo app('translator')->get('My Packages'); ?></h3>
                </div>
                <!-- search area -->
                <div class="search-bar my-search-bar">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="input-box">
                                    <input type="text" name="name" value="<?php echo e(old('name',request()->name)); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Search Package'); ?>"/>
                                </div>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="purchase_date" autofocus="off" readonly placeholder="<?php echo app('translator')->get('purchased date'); ?>" value="<?php echo e(old('purchase_date',request()->purchase_date)); ?>">
                                </div>

                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <input type="text" class="form-control datepicker" name="expire_date" autofocus="off" readonly placeholder="Expired date" value="<?php echo e(old('expire_date',request()->expire_date)); ?>">
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <select name="package_status" id="package_status" class="form-control js-example-basic-single">
                                    <option selected disabled><?php echo app('translator')->get('Validity'); ?></option>
                                    <option value="active" <?php echo e(request()->package_status == 'active' ? 'selected' : ''); ?>><?php echo app('translator')->get('Active'); ?></option>
                                    <option value="expired" <?php echo e(request()->package_status == 'expired' ? 'selected' : ''); ?>><?php echo app('translator')->get('Expired'); ?></option>
                                </select>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <select name="status" class="form-control js-example-basic-single">
                                    <option selected disabled><?php echo app('translator')->get('Status'); ?></option>
                                    <option value="0" <?php if(@request()->status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Pending'); ?></option>
                                    <option value="1" <?php if(@request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Approved'); ?></option>
                                    <option value="2" <?php if(@request()->status == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Cancelled'); ?></option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <button class="btn-custom" type="submit"><?php echo app('translator')->get('search'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Package'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('No. of listing'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Purchased Date'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Expired Date'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Validity'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                            <th scope="col" class="text-end"><?php echo app('translator')->get('Action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $my_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="company-logo" data-label="Package">
                                    <?php echo app('translator')->get(optional($item->get_package)->title); ?>
                                </td>
                                <td data-label="No. of listing">
                                    <?php if($item->no_of_listing == null): ?>
                                        <span class="badge rounded-pill bg-primary"><?php echo app('translator')->get('Unlimited'); ?></span>
                                    <?php else: ?>
                                        <?php echo e($item->no_of_listing); ?>

                                    <?php endif; ?>
                                </td>

                                <td data-label="Purchased Date">
                                    <?php echo e(\Illuminate\Support\Carbon::parse($item->purchase_date)->format('m/d/Y')); ?>

                                </td>

                                <td data-label="Expired Date">
                                    <?php if($item->expire_date == null): ?>
                                        <span class="badge rounded-pill bg-primary"><?php echo app('translator')->get('Unlimited'); ?></span>
                                    <?php else: ?>
                                        <?php echo e(\Illuminate\Support\Carbon::parse($item->expire_date)->format('m/d/Y')); ?>

                                    <?php endif; ?>
                                    <p class="expire__date" data-date="<?php echo e(\Illuminate\Support\Carbon::parse($item->expire_date)->format('Y-m-d')); ?>" data-package="<?php echo e($item->id); ?>"></p>
                                </td>

                                <td data-label="Validity">
                                    <?php if(\Carbon\Carbon::now()->format('Y-m-d') <= \Carbon\Carbon::parse($item->expire_date)): ?>
                                        <span class="badge rounded-pill bg-success"><?php echo app('translator')->get('Active'); ?></span>
                                    <?php elseif($item->expire_date == null): ?>
                                        <span class="badge rounded-pill bg-success"><?php echo app('translator')->get('Active'); ?></span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-danger"><?php echo app('translator')->get('Expired'); ?></span>
                                    <?php endif; ?>
                                </td>


                                <td data-label="Status">
                                    <?php if($item->status == 0): ?>
                                        <span class="badge rounded-pill bg-danger"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php elseif($item->status == 1 || optional($item->gateway)->status == 1): ?>
                                        <span class="badge rounded-pill bg-info"><?php echo app('translator')->get('Approved'); ?></span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-warning"><?php echo app('translator')->get('Cancel'); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown-btns">
                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-ellipsis-v"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <?php if($item->price != null): ?>
                                                <li>
                                                    <a href="<?php echo e(route('user.paymentHistory', $item->id)); ?>" class="btn  dropdown-item">
                                                        <i class="fal fa-sack-dollar text-info me-2"></i> <?php echo app('translator')->get('Payment History'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($item->expire_date != null && $item->status != 0 && optional($item->getPlanInfo)->is_renew == 1): ?>
                                                <li>
                                                    <a href="javascript:void(0)" class="btn  notiflix-confirm renewPackage dropdown-item" data-price="<?php echo e((optional($item->getPlanInfo)->price == null ? 0 : optional($item->getPlanInfo)->price)); ?>" data-plan="<?php echo e(optional(optional($item->getPlanInfo)->details)->title); ?>" data-route="<?php echo e(route('user.renewPackage', $item->id)); ?>" data-listing="<?php echo e($item->no_of_listing); ?>" data-expiretime="<?php echo e(optional($item->getPlanInfo)->expiry_time); ?>" data-expiretype="<?php echo e(optional($item->getPlanInfo)->expiry_time_type); ?>" data-purchasepackageexpiredate="<?php echo e(\Illuminate\Support\Carbon::parse($item->expire_date)->format('Y-m-d')); ?>">
                                                        <i class="fal fa-wind-turbine text-success me-2"></i> <?php echo app('translator')->get('Renew Package'); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(($item->no_of_listing > 0 || $item->no_of_listing == null) && ($item->expire_date == null ||  \Carbon\Carbon::now() <= \Carbon\Carbon::parse($item->expire_date)) && ($item->status == 1)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('user.addListing', $item->id)); ?>" class="btn  dropdown-item"> <i class="fal fa-box-open text-success me-2"></i> <?php echo app('translator')->get('Add Listing'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td class="text-center" colspan="100%"> <?php echo app('translator')->get('No Data Found'); ?></td>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($my_packages->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('loadModal'); ?>
        <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top modal-md">
                <div class="modal-content">
                    <div class="modal-header modal-primary modal-header-custom">
                        <h4 class="modal-title" id="editModalLabel"><?php echo app('translator')->get('Delete Confirmation'); ?></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo app('translator')->get('Are you sure delete?'); ?>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="post" class="deleteRoute">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button type="submit" class="btn btn-primary addCreateListingRoute"><?php echo app('translator')->get('Confirm'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="renewPackageModal" tabindex="-1" aria-labelledby="addListingmodal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title text-white" id="editModalLabel"><?php echo app('translator')->get('Package Renew Information'); ?></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <form action="" method="get" enctype="multipart/form-data" class="renewPackageForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header payment-method-details plan-name">
                                </div>
                                <div class="card-body">
                                    <div class="estimation-box">
                                        <div class="details_list">
                                            <ul>
                                                <li class="d-flex justify-content-between"><span><?php echo app('translator')->get('Price'); ?></span><span class="plan-price"></span></li>
                                                <li class="d-flex justify-content-between"><span><?php echo app('translator')->get('No. Of Listing'); ?></span> <span class="plan-listing"></span></li>
                                                <li class="d-flex justify-content-between"><span><?php echo app('translator')->get('Validity'); ?></span> <span class="package-validity"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <button type="submit" class="btn btn-primary addCreateListingRoute"><?php echo app('translator')->get('Confirm'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/bootstrap-datepicker.js')); ?>"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({
                autoclose: true,
                clearBtn: true
            });

            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
        });
    </script>

    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.renewPackage', function () {
                var planModal = new bootstrap.Modal(document.getElementById('renewPackageModal'))
                planModal.show()

                let dataRoute = $(this).data('route');
                $('.renewPackageForm').attr('action', dataRoute);

                let plan_name = $(this).data('plan');
                let symbol = "<?php echo e(trans($basic->currency_symbol)); ?>";
                let price = $(this).data('price');
                let listing = $(this).data('listing');

                let plan_expire_time = $(this).data('expiretime');
                let plan_expire_type = $(this).data('expiretype');
                let packageValidity = plan_expire_time + ' ' + plan_expire_type;

                $('.plan-name').text(plan_name);
                $('.plan-price').text(`${symbol}${price}`);

                if (listing == '') {
                    $('.plan-listing').text(`<?php echo app('translator')->get('Unlimited'); ?>`);

                } else {
                    $('.plan-listing').text(`${listing}`);
                }

                if (plan_expire_time == '') {
                    $('.package-validity').text(`<?php echo app('translator')->get('Unlimited'); ?>`);
                } else {
                    $('.package-validity').text(`${packageValidity}`);
                }

            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/user/package.blade.php ENDPATH**/ ?>