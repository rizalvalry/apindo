
<?php $__env->startSection('title',trans('Dashboard')); ?>
<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Total Listings'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.allListing')); ?>">
                                    <?php echo e(number_format($listings['listing_infos'])); ?>

                                </a>
                            </h3>
                            <i class="fal fa-box-open"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Active Listings'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.allListing', 'approved')); ?>">
                                    <?php echo e(number_format($listings['activeListing'])); ?>

                                </a>
                            </h3>
                            <i class="fal fa-box-open"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Pending Listings'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.allListing', 'pending')); ?>">
                                    <?php echo e(number_format($listings['pendingListing'])); ?>

                                </a>
                            </h3>
                            <i class="fal fa-box-open"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Views'); ?></h5>
                            <h3>
                                <a href="#"><?php echo e($all_viewers_count); ?></a>

                            </h3>
                            <i class="fal fa-street-view"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5><?php echo app('translator')->get('Products'); ?></h5>
                            <h3>
                                <a href="#"><?php echo e($totalProduct); ?></a>
                            </h3>
                            <i class="fal fa-shopping-basket"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5><?php echo app('translator')->get('Unseen Enquiries'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.productQuery', 'customer-enquiry')); ?>"><?php echo e($productUnseenQuires); ?></a>
                            </h3>
                            <i class="fal fa-envelope-open-text"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5><?php echo app('translator')->get('Active Package'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.myPackages')); ?>">
                                    <?php echo e($activePackage); ?>

                                </a>
                            </h3>
                            <i class="fal fa-box-full" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5><?php echo app('translator')->get('Pending Package'); ?></h5>
                            <h3>
                                <a href="<?php echo e(route('user.myPackages')); ?>">
                                    <?php echo e($pendingPackage); ?>

                                </a>
                            </h3>
                            <i class="fal fa-box-full" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <!-- charts -->
                <section class="chart-information">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="progress-wrapper p-3">
                                <h3 class="card-title"><?php echo app('translator')->get("Upcoming Expired Packages"); ?></h3>
                                <div id="calendar"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="progress-wrapper">
                                <h3 class="my__package__heading"><?php echo app('translator')->get('My Packages'); ?></h3>
                                <div class="progress-container d-flex flex-column flex-sm-row justify-content-around mt-3 mt-sm-5 pb-3 pb-sm-5">
                                    <?php $__empty_1 = true; $__currentLoopData = $userPurchasePackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php if($package->no_of_listing != null): ?>
                                            <?php
                                                $total_listing = optional($package->getPlanInfo)->no_of_listing;
                                                $remaining_listing = $package->no_of_listing;
                                                $expence_listing = $total_listing - $remaining_listing;
                                                $total_used_listing_percent = $expence_listing * 100 / $total_listing;
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $total_used_listing_percent = 'Unlimited';
                                            ?>
                                        <?php endif; ?>

                                        <?php for($i = $key; $i <= $key; $i++): ?>
                                            <?php if($package->no_of_listing != null): ?>
                                                <div class="circular-progress cp_1 mt-sm-5 mt-3 pb-sm-5 pb-3">
                                                    <svg class="radial-progress" data-percentage="<?php echo e($total_used_listing_percent); ?>" viewBox="0 0 80 80">
                                                        <circle class="incomplete plan-stroke<?php echo e($i); ?>" cx="40" cy="40" r="35"></circle>
                                                        <circle class="complete same-cricle plan-stroke-percent<?php echo e($i); ?>" cx="40" cy="40" r="35"></circle>
                                                        <text class="percentage" x="50%" y="53%" transform="matrix(0, 1, -1, 0, 80, 0)">
                                                            <?php echo e((int)$total_used_listing_percent); ?> %
                                                        </text>
                                                        <i class="fal fa-box-open mt-2"></i> <?php echo app('translator')->get('Used'); ?>
                                                    </svg>
                                                    <h4 class="golden-text mt-4 text-center">
                                                        <a href="<?php echo e(route('user.myPackages', $package->id)); ?>">
                                                            <?php echo app('translator')->get(optional($package->get_package)->title); ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                            <?php else: ?>
                                                <div class="circular-progress cp_1 circular-progress cp_1 circular-progress cp_1 circular-progress cp_1 mt-5 pb-5">
                                                    <svg class="radial-progress" data-percentage="0" viewBox="0 0 80 80">
                                                        <circle class="incomplete plan-stroke<?php echo e($i); ?>" cx="40" cy="40" r="35"></circle>
                                                        <circle class="complete same-cricle plan-stroke-percent<?php echo e($i); ?>" cx="40" cy="40" r="35"></circle>
                                                        <text class="percentage" x="50%" y="53%" transform="matrix(0, 1, -1, 0, 80, 0)">
                                                            <?php echo app('translator')->get('Unlimited'); ?>
                                                        </text>
                                                        <i class="fal fa-box-open mt-2"></i>
                                                        <i class="far fa-infinity mt-2"></i>
                                                    </svg>
                                                    <h4
                                                        class="golden-text mt-4 text-center">
                                                        <a href="<?php echo e(route('user.myPackages', $package->id)); ?>">
                                                            <?php echo app('translator')->get(optional($package->get_package)->title); ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- search area -->
                <div class="search-bar p-0">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" name="listing_search_name" class="form-control" placeholder="<?php echo app('translator')->get('Listing'); ?>" value="<?php echo e(request()->listing_search_name); ?>"/>
                                </div>
                            </div>
                            <div class="input-box col-lg-4 col-md-4 col-sm-12">
                                <select class="js-example-basic-single form-control"
                                        name="listing_location_name">
                                    <option value="" selected disabled><?php echo app('translator')->get('Enter Location'); ?></option>
                                    <?php $__currentLoopData = $all_listing_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($address); ?>" <?php echo e(request()->listing_location_name == $address ? 'selected' : ''); ?>><?php echo app('translator')->get($address); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button class="btn-custom" type="submit"><?php echo app('translator')->get('search'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <div class="p-2">
                        <h4><?php echo app('translator')->get('Latest Listings'); ?></h4>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Package'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Category'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Listing'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Address'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                            <th scope="col" class="text-end"><?php echo app('translator')->get('Action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $user_listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>
                                <td data-label="Package">
                                    <?php echo e(optional(optional($item->get_package)->get_package)->title); ?>

                                </td>

                                <td data-label="Category">
                                    <?php echo e($item->getCategoriesName()); ?>

                                </td>

                                <td data-label="Listing">
                                    <a href="<?php echo e(route('listing-details',[slug($item->title), $item->id])); ?>" target="_blank"><?php echo app('translator')->get($item->title); ?></a>
                                </td>

                                <td data-label="Address"><?php echo app('translator')->get($item->address); ?></td>

                                <td data-label="Status">
                                    <?php if($item->status == 1): ?>
                                        <span class="badge  bg-success"><?php echo app('translator')->get('Approved'); ?></span>
                                    <?php elseif($item->status == 2): ?>
                                        <span class="badge  bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                    <?php else: ?>
                                        <span class="badge  bg-info"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <div class="dropdown-btns">
                                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="<?php echo e(route('user.analytics', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                    <i class="fal fa-analytics me-2"></i> <?php echo app('translator')->get('Analytics'); ?>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo e(route('user.reviews', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                    <i class="far fa-star me-2"></i> <?php echo app('translator')->get('Reviews'); ?>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo e(route('user.editListing', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                    <i class="far fa-edit me-2"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn currentColor notiflix-confirm dropdown-item" data-route="<?php echo e(route('user.listingDelete', $item->id)); ?>">
                                                    <i class="far fa-trash-alt me-2"></i> <?php echo app('translator')->get('Delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td class="text-center" colspan="100%"> <?php echo app('translator')->get('No Data Found'); ?></td>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('loadModal'); ?>
        <!-- Delete Modal -->
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
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/fullcalendar.min.css')); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('extra-js'); ?>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
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
            events: "<?php echo e(route('user.calender')); ?>",
            eventColor: "#1c2d41",
            height: 500
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/user/dashboard.blade.php ENDPATH**/ ?>