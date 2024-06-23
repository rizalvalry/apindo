
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row admin-fa_icon">
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($userRecord['totalUser'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Total Users'); ?>
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa custom__icon__color3 fa-users fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($userRecord['activeUser'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Total Active Users'); ?>
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa custom__icon__color3 fa-users fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e($userRecord['todayJoin']); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Today Join User'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa custom__icon__color3 fa-users fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e($totalSubscriber); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Total Subscribers'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa custom__icon__color3 fa-users fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($listings['totalListing'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Total Listings'); ?>
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-list-ol" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($listings['activeListing'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Active Listings'); ?>
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-list-ol" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($listings['pendingListing'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Pending Listings'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-list-ol" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($listings['todayCreatedListings'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Today's Listings"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-list-ol" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e($totalPackage); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Total Package"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x fa-shopping-cart" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($sellPackage['totalPurchasePackage'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Total Sold Package"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x fa-shopping-cart" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($sellPackage['todayPurchasePackage'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Today's Sold Package"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x fa-shopping-cart" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e($totalPendingPackage); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Pending Package"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x  fa-shopping-cart" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title"><?php echo app('translator')->get("This Month's Summary"); ?></h4>
                                <div>
                                    <canvas id="line-chart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row admin-fa_icon ">
            <div class="col-md-12">
                <h4 class="card-title"><?php echo app('translator')->get('Payment Statistics'); ?></h4>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(trans($basic->currency_symbol)); ?><?php echo e(getAmount($funding['totalAmountReceived'],config('basic.fraction_number'))); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Total Payment"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-hand-holding-usd"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(trans($basic->currency_symbol)); ?><?php echo e(getAmount($funding['todayDeposit'],config('basic.fraction_number'))); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Today's Payment"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-hand-holding-usd"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(trans($basic->currency_symbol)); ?><?php echo e(getAmount($funding['totalChargeReceived'],config('basic.fraction_number'))); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Payment Charge"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-hand-holding-usd"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(getAmount($gateways)); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get("Gateways"); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x custom__icon__color2 fa-university"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row admin-fa_icon ">
            <div class="col-md-12">
                <h4 class="card-title"><?php echo app('translator')->get('Tickets'); ?></h4>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($tickets['closed'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Closed Ticket'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x  fa-times-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($tickets['replied'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Replied Ticket'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x  fa-inbox"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($tickets['answered'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Answered Ticket'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x  fa-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo e(number_format($tickets['pending'])); ?></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate"><?php echo app('translator')->get('Pending Ticket'); ?></h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-2x  fa-spinner"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(adminAccessRoute(config('role.manage_user.access.view'))): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo app('translator')->get('Latest User'); ?></h4>
                            <div class="table-responsive">
                                <table class="categories-show-table table table-hover table-striped table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                                        <th scope="col"><?php echo app('translator')->get('Phone'); ?></th>
                                        <th scope="col"><?php echo app('translator')->get('Last Login'); ?></th>
                                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                        <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $latestUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td data-label="<?php echo app('translator')->get('User'); ?>">
                                                <div class="float-left">
                                                    <a href="<?php echo e(route('admin.user-edit',[$user->id])); ?>" target="_blank">
                                                        <img src="<?php echo e(getFile($user->driver, $user->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="contactImageUser">
                                                    </a>
                                                </div>
                                                <div class="float-left">
                                                    <?php echo app('translator')->get($user->fullname); ?><br>
                                                    <?php echo app('translator')->get($user->email); ?>
                                                </div>
                                            </td>
                                            <td data-label="<?php echo app('translator')->get('Phone'); ?>">
                                                <?php if($user->phone): ?>
                                                    <?php echo e($user->phone); ?>

                                                <?php else: ?>
                                                    <?php echo app('translator')->get('N/A'); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td data-label="<?php echo app('translator')->get('Last Login'); ?>"><?php echo e(diffForHumans($user->last_login)); ?></td>

                                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                            <span
                                                class="badge badge-pill <?php echo e($user->status == 0 ? 'badge-danger' : 'badge-success'); ?>"><?php echo e($user->status == 0 ? 'Inactive' : 'Active'); ?></span>
                                            </td>
                                            <?php if(adminAccessRoute(config('role.manage_user.access.edit'))): ?>
                                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                                    <div class="dropdown show">
                                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink"
                                                           data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                               href="<?php echo e(route('admin.user-edit',$user->id)); ?>">
                                                                <i class="fa fa-edit text-warning pr-2"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Edit'); ?>
                                                            </a>

                                                            <a class="dropdown-item"
                                                               href="<?php echo e(route('admin.send-email',$user->id)); ?>">
                                                                <i class="fa fa-envelope text-success pr-2"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Send Email'); ?>
                                                            </a>
                                                            <a class="dropdown-item loginAccount" type="button"
                                                               data-toggle="modal"
                                                               data-target="#signIn"
                                                               data-route="<?php echo e(route('admin.login-as-user',$user->id)); ?>">
                                                                <i class="fa fa-sign-in-alt text-success pr-2"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->get('Login as User'); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td class="text-center text-danger" colspan="100%"><?php echo app('translator')->get('No User Data'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if($basic->is_active_cron_notification): ?>
        <div class="modal fade" id="cron-info" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title">
                            <i class="fa fa-2x s fa-info-circle"></i>
                            <?php echo app('translator')->get('Cron Job Set Up Instruction'); ?>
                        </h5>
                        <button type="button" class="close cron-notification-close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="bg-orange text-white p-2">
                                    <i><?php echo app('translator')->get('**To sending emails and sms and updating Package expire date  automatically you need to setup cron job in your server. Make sure your job is running properly. We insist to set the cron job time as minimum as possible.**'); ?></i>
                                </p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label><strong><?php echo app('translator')->get('Command for Email & SMS'); ?></strong></label>
                                <div class="input-group ">
                                    <input type="text" class="form-control copyText"
                                           value="curl -s <?php echo e(route('queue.work')); ?>" disabled>
                                    <div class="input-group-append">
                                        <button class="input-group-text bg-primary btn btn-primary text-white copy-btn">
                                            <i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label><strong><?php echo app('translator')->get('Command for Package Expired Check'); ?></strong></label>
                                <div class="input-group ">
                                    <input type="text" class="form-control copyText"
                                           value="curl -s <?php echo e(route('cron')); ?>"
                                           disabled>
                                    <div class="input-group-append">
                                        <button class="input-group-text bg-primary btn btn-primary text-white copy-btn">
                                            <i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <p class="bg-dark text-white p-2">
                                    <?php echo app('translator')->get('*To turn off this pop up go to '); ?>
                                    <a href="<?php echo e(route('admin.basic-controls')); ?>"
                                       class="text-orange"><?php echo app('translator')->get('Basic control'); ?></a>
                                    <?php echo app('translator')->get(' and disable `Cron Set Up Pop Up`.*'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/fullcalendar.min.css')); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js-lib'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/Chart.min.js')); ?>"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
    <script>
        "use strict";
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($statistics['schedule']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($statistics['deposit']->values(), 15, 512) ?>,
                    label: "Payment",
                    borderColor: "#6fbbff",
                    fill: false
                }, {
                    data: <?php echo json_encode($statistics['purchasedPackage']->values(), 15, 512) ?>,
                    label: "Purchased Package",
                    borderColor: "#ff6f62",
                    fill: false
                }, {
                    data: <?php echo json_encode($statistics['totalCreatedListings']->values(), 15, 512) ?>,
                    label: "Total Listings",
                    borderColor: "#98df8a",
                    fill: false
                }, {
                    data: <?php echo json_encode($statistics['totalClaimListings']->values(), 15, 512) ?>,
                    label: "Claim Listings",
                    borderColor: "#8b6ef3",
                    fill: false
                }
                ]
            }
        });


        $(document).on('click', '#details', function () {
            var title = $(this).data('servicetitle');
            var description = $(this).data('description');
            $('#title').text(title);
            $('#servicedescription').text(description);
        });

        $(document).ready(function () {
            let isActiveCronNotification = '<?php echo e($basic->is_active_cron_notification); ?>';
            if (isActiveCronNotification == 1)
                $('#cron-info').modal('show');
            $(document).on('click', '.copy-btn', function () {
                var _this = $(this)[0];
                var copyText = $(this).parents('.input-group-append').siblings('input');
                $(copyText).prop('disabled', false);
                copyText.select();
                document.execCommand("copy");
                $(copyText).prop('disabled', true);
                $(this).text('Coppied');
                setTimeout(function () {
                    $(_this).text('');
                    $(_this).html('<i class="fa fa-2x s fa-copy"></i>');
                }, 300)
            });
        })
    </script>

    <script>
        "use strict";
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#calendar').fullCalendar({
            themeSystem: 'bootstrap5',
            header: {
                left: 'today',
                center: 'prev title next',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: "<?php echo e($handover); ?>",
            editable: false,
            eventLimit: true,
            events: "<?php echo e(route('admin.calender')); ?>",
            eventColor: "#1c2d41",
            height: 500
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>