
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("User List"); ?>
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
                <form action="<?php echo e(route('admin.users.search')); ?>" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="search" value="<?php echo e(@request()->search); ?>" class="form-control"
                                       placeholder="<?php echo app('translator')->get('Type Here'); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_time" id="datepicker"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value=""><?php echo app('translator')->get('All User'); ?></option>
                                    <option value="1"
                                            <?php if(@request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Active User'); ?></option>
                                    <option value="0"
                                            <?php if(@request()->status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Inactive User'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn w-100 btn-primary"><i
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
            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> <?php echo app('translator')->get('Action'); ?></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active"><?php echo app('translator')->get('Active'); ?></button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive"><?php echo app('translator')->get('Inactive'); ?></button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                       id="check-all">
                                <label for="check-all"></label>
                            </th>
                        <?php endif; ?>
                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Last Login'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-<?php echo e($user->id); ?>"
                                           class="form-check-input row-tic tic-check" name="check" value="<?php echo e($user->id); ?>"
                                           data-id="<?php echo e($user->id); ?>">
                                    <label for="chk-<?php echo e($user->id); ?>"></label>
                                </td>
                            <?php endif; ?>
                            <td data-label="<?php echo app('translator')->get('No.'); ?>"><?php echo e(loopIndex($users) + $loop->index); ?></td>

                            <td data-label="<?php echo app('translator')->get('Username'); ?>">
                                <div class="float-left">
                                    <a href="<?php echo e(route('admin.user-edit',$user->id)); ?>" target="_blank">
                                        <img src="<?php echo e(getFile($user->driver, $user->image)); ?>"
                                             alt="<?php echo e(config('basic.site_title')); ?>" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get($user->username); ?> <br>
                                    <?php echo app('translator')->get($user->email); ?>
                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Last Login'); ?>"><?php echo e(diffForHumans($user->last_login)); ?></td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="badge badge-pill <?php echo e($user->status == 0 ? 'badge-danger' : 'badge-success'); ?>"><?php echo e($user->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>
                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown show ">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink"
                                           data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php echo e(route('admin.user-edit',$user->id)); ?>">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('admin.send-email',$user->id)); ?>">
                                                <i class="fa fa-envelope text-success pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Send Email'); ?>
                                            </a>
                                            <a class="dropdown-item loginAccount" type="button"
                                               data-toggle="modal"
                                               data-target="#signIn"
                                               data-route="<?php echo e(route('admin.login-as-user',$user->id)); ?>">
                                                <i class="fas fa-sign-in-alt text-success pr-2"
                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Login as User'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-center text-danger" colspan="9"><?php echo app('translator')->get('No User Data'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($users->appends(@$search)->links('partials.pagination')); ?>


            </div>
        </div>
    </div>

    <!-- Admin Login as a User Modal -->
    <div class="modal fade" id="signIn">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" class="loginAccountAction" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title"><?php echo app('translator')->get('Sing In Confirmation'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to sign in this account?'); ?></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span><?php echo app('translator')->get('Yes'); ?></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('Active User Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to active the User's"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="javascript:void(0)"  class="btn btn-primary active-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title"><?php echo app('translator')->get('DeActive User Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get("Are you really want to Inactive the User's"); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <a href="javascript:void(0)"  class="btn btn-primary inactive-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        "use strict";

        $(document).on('click', '.loginAccount', function () {
            var route = $(this).data('route');
            $('.loginAccountAction').attr('action', route)
        });

        $(document).on('click', '#check-all', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        $(document).on('change', ".row-tic", function () {
            let length = $(".row-tic").length;
            let checkedLength = $(".row-tic:checked").length;
            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        //dropdown menu is not working
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //multiple active
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.user-multiple-active')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                },
            });
        });

        //multiple deactive
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "<?php echo e(route('admin.user-multiple-inactive')); ?>",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                }
            });
        });


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/users/list.blade.php ENDPATH**/ ?>