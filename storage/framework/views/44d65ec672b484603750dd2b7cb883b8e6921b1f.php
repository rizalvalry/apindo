
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("Purchase Package List"); ?>
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
                                <label for="title"> <?php echo app('translator')->get('Filter By User'); ?></label>
                                <select name="user" class="form-control filter__by__user">
                                    <option selected disabled><?php echo app('translator')->get('Select User'); ?></option>
                                    <?php $__currentLoopData = $allDistinctUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $firstname = optional($user->get_user)->firstname;
                                            $lastname = optional($user->get_user)->lastname;
                                            $fullname = $firstname." ".$lastname;
                                        ?>
                                        <option value="<?php echo e($user->user_id); ?>" <?php echo e(request()->user == $user->user_id ? 'selected' : ''); ?>><?php echo app('translator')->get($fullname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('Package'); ?></label>
                                <select name="package" class="form-control">
                                    <option selected disabled><?php echo app('translator')->get('Select Package'); ?></option>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($package->id); ?>" <?php echo e(request()->package ==  $package->id ? 'selected' : ''); ?>><?php echo app('translator')->get(optional($package->details)->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('Validity'); ?></label>
                                <select name="package_status" class="form-control">
                                    <option value="active" <?php echo e(request()->package_status == 'active' ? 'selected' : ''); ?>><?php echo app('translator')->get('Active'); ?></option>
                                    <option value="expired" <?php echo e(request()->package_status == 'expired' ? 'selected' : ''); ?>><?php echo app('translator')->get('Expired'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('Status'); ?></label>
                                <select name="status" class="form-control">
                                    <option selected disabled><?php echo app('translator')->get('Status'); ?></option>
                                    <option value="0"
                                            <?php if(@request()->status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Pending'); ?></option>
                                    <option value="1"
                                            <?php if(@request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Approved'); ?></option>
                                    <option value="2"
                                            <?php if(@request()->status == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Cancelled'); ?></option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('From Date'); ?></label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="<?php echo app('translator')->get('From date'); ?>" value="<?php echo e(old('from_date', request()->from_date)); ?>"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('To Date'); ?></label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="<?php echo app('translator')->get('To date'); ?>" value="<?php echo e(old('to_date', request()->to_date)); ?>" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn w-100 w-md-auto btn-primary listing-btn-search-custom mt-2"><i
                                        class="fas fa-search"></i> <?php echo app('translator')->get('Search'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div class="col-md-auto package_export_box mt-2 ml-2 d-none">
            <div class="form-group">

                <form action="<?php echo e(route('admin.export.packages.excel')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="package_id" class="export_selected_packages">
                    <button type="submit" class="btn btn-outline-info btn-rounded btn-sm"><?php echo e(__('Export Excel')); ?></button>
                </form>

                <form action="<?php echo e(route('admin.export.packages.csv')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="package_id" class="export_selected_packages">
                    <button type="submit" class="btn btn-outline-success btn-rounded btn-sm"><?php echo e(__('Export Csv')); ?></button>
                </form>
                <button class="btn btn-outline-danger btn-rounded btn-sm d-inline btn-sm" data-toggle="modal" data-target="#delete_selected_packages"><?php echo e(__('Delete')); ?></button>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <?php if(adminAccessRoute(config('role.manage_package.access.edit')) == true): ?>
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check check_all" value="1" name="check-all"
                                       id="check-all" data-status="all">
                                <label for="check-all"></label>
                            </th>
                        <?php endif; ?>

                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Package'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Purchased Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Expired Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Validity'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $all_purchase_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_package.access.edit')) == true): ?>
                                <td class="text-center">
                                    <input type="checkbox" name="id[]"
                                           value="<?php echo e($package->id); ?>"
                                           class="form-check-input row-tic tic-check"
                                           id="customCheck<?php echo e($package->id); ?>"
                                           data-id="<?php echo e($package->id); ?>"
                                           data-package = "<?php echo e(optional($package->get_package)->title); ?>">
                                    <label for="customCheck<?php echo e($package->id); ?>"></label>
                                </td>
                            <?php endif; ?>

                            <td data-label="<?php echo app('translator')->get('No.'); ?>"><?php echo e(loopIndex($all_purchase_packages) + $loop->index); ?></td>
                            <td data-label="<?php echo app('translator')->get('User'); ?>">
                                <div class="float-left">
                                    <a href="<?php echo e(route('admin.user-edit', optional($package->get_user)->id)); ?>" target="_blank">
                                        <img src="<?php echo e(getFile(optional($package->get_user)->driver, optional($package->get_user)->image)); ?>" alt="" class="contactImageUser">
                                    </a>


                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get(optional($package->get_user)->firstname); ?> <?php echo app('translator')->get(optional($package->get_user)->lastname); ?> <br>
                                    <?php echo app('translator')->get(optional($package->get_user)->email); ?>
                                </div>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Package Name'); ?>"><?php echo app('translator')->get(optional(optional($package->getPlanInfo)->details)->title); ?></td>

                            <td data-label="<?php echo app('translator')->get('Purchased Date'); ?>"><?php echo e($package->purchase_date->format('m/d/y')); ?></td>

                            <td data-label="<?php echo app('translator')->get('Expired date'); ?>">
                                <?php if($package->expire_date == null): ?>
                                    <span class="badge badge-pill badge-success"><?php echo app('translator')->get('Unlimited'); ?></span>
                                <?php else: ?>
                                    <?php echo e($package->expire_date->format('m/d/y')); ?>

                                <?php endif; ?>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Validity'); ?>">
                                <?php if(\Carbon\Carbon::now()->format('Y-m-d') <= \Carbon\Carbon::parse($package->expire_date)): ?>
                                    <span class="badge badge-pill bg-success text-white"><?php echo app('translator')->get('Active'); ?></span>
                                <?php elseif($package->expire_date == null): ?>
                                    <span class="badge badge-pill bg-success text-white"><?php echo app('translator')->get('Active'); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-pill bg-danger text-white"><?php echo app('translator')->get('Expired'); ?></span>
                                <?php endif; ?>
                            </td>

                            <?php
                                $fundInfo = \App\Models\Fund::where('purchase_package_id', $package->id)->latest()->first();
                            ?>


                            <?php if($package->status == 0 || $package->status == 2 || ($fundInfo && ($fundInfo->status == 2 || $fundInfo->status == 3))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>" class="text-center">
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.payment.pending', $package->id)); ?>">
                                                <i class="fa fa-dollar-sign pr-2"></i>  <?php echo app('translator')->get('Payment History'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>" class="text-center">
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.payment.log', $package->id)); ?>">
                                                <i class="fa fa-dollar-sign pr-2"></i>  <?php echo app('translator')->get('Payment History'); ?>
                                            </a>
                                        </div>
                                    </div>
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
                <?php echo e($all_purchase_packages->appends(@$search)->links('partials.pagination')); ?>

            </div>
        </div>
    </div>

    <?php $__env->startPush('adminModal'); ?>

        <div id="delete_selected_packages" class="modal fade" tabindex="-1" role="dialog"
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
                        <p><?php echo app('translator')->get('Are you sure to delete?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="<?php echo e(route('admin.selected.package.delete')); ?>" method="post" enctype="multipart/form-data" class="deleteRoute">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <input type="hidden" name="package_id" class="package_id_checked">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
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



    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled')
            });

            $('.filter__by__user').select2({
                selectOnClose: true,
                width:'100%'
            });
        });
    </script>

    <script>
        'use strict'
        $(document).ready(function (){
            var package_array = [];
            $(document).on('click', '.check_all', function (){
                package_array = [];
                if(this.checked){
                    console.log('checked');
                    $('.package_export_box').removeClass('d-none');
                    $('.package_export_box').removeClass('d-none');

                    $('.row-tic').each(function(){
                        $(this).prop('checked', true);
                        package_array.push($(this).attr('data-id'));
                        $('.package_id_checked').val(package_array);
                        $('.export_selected_packages').val(package_array);
                    });

                }else{

                    $('.package_export_box').addClass('d-none');

                    $('.row-tic').each(function(){

                        $(this).prop('checked', false);
                        $('.package_id_checked').val(package_array);
                        $('.export_selected_packages').val(package_array);

                    });
                }

                if(package_array.length == 0)
                {
                    $('.package_export_box').addClass('d-none');
                }else{
                    $('.package_export_box').removeClass('d-none');
                }
            })


            $(document).on("click", ".row-tic", function(){
                var data_id = $(this).attr('data-id');
                $('.row-tic').each(function(){
                    if($(this).is(':checked')){
                        $('.check_all').prop('checked', true)
                    } else{
                        $('.check_all').prop('checked', false)
                        return false;
                    }
                });

                if(package_array.indexOf(data_id)  != -1){
                    package_array = package_array.filter(item => item !== data_id)
                    $('.package_id_checked').val(package_array);
                    $('.export_selected_packages').val(package_array);
                }
                else{
                    package_array.push(data_id)
                    $('.package_id_checked').val(package_array);
                    $('.export_selected_packages').val(package_array);
                }


                if(package_array.length == 0)
                {
                    $('.package_export_box').addClass('d-none');
                }else{
                    $('.package_export_box').removeClass('d-none');
                }

            });
        })
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/package/purchasePackageList.blade.php ENDPATH**/ ?>