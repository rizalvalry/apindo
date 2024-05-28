<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get("User Listing List"); ?>
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
                                <label for="title"> <?php echo app('translator')->get('Listing'); ?></label>
                                <input type="text" name="title" value="<?php echo e(old('title',request()->title)); ?>" class="form-control"
                                       placeholder="<?php echo app('translator')->get('Listing..'); ?>">
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

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('Listing Category'); ?></label>
                                <select name="category[]" class="form-control listing__category__select2" multiple>
                                    <option value="all"
                                            <?php if(request()->category && in_array('all', request()->category)): ?>
                                                selected
                                        <?php endif; ?>><?php echo app('translator')->get('All Category'); ?></option>
                                    <?php $__currentLoopData = $listingCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                                <?php if(request()->category && in_array($category->id, request()->category)): ?>
                                                    selected
                                            <?php endif; ?>><?php echo app('translator')->get(optional($category->details)->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('Location'); ?></label>
                                <select name="location" class="form-control">
                                    <option selected disabled><?php echo app('translator')->get('Enter Location'); ?></option>
                                    <?php $__currentLoopData = $allLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($location->id); ?>" <?php echo e(request()->location == $location->id ? 'selected' : ''); ?>><?php echo app('translator')->get(optional($location->details)->place); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('From Date'); ?></label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="<?php echo app('translator')->get('From date'); ?>" value="<?php echo e(old('from_date', request()->from_date)); ?>"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="title"> <?php echo app('translator')->get('To Date'); ?></label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="<?php echo app('translator')->get('To date'); ?>" value="<?php echo e(old('to_date', request()->to_date)); ?>" disabled="true"/>
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
                                            <?php if(@request()->status == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Rejected'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
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

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true): ?>
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> <?php echo app('translator')->get('Action'); ?></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active"><i class="fas fa-check pr-2"></i> <?php echo app('translator')->get('Approved'); ?></button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive"><i class="fas fa-times pr-2"></i> <?php echo app('translator')->get('Rejected'); ?></button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true): ?>
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>
                        <?php endif; ?>
                        <th scope="col"><?php echo app('translator')->get('No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Package'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Listing'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Category'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Address'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Stage'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true || adminAccessRoute(config('role.manage_listing.access.delete')) == true): ?>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $all_user_listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true): ?>
                            <td class="text-center">
                                <input type="checkbox" id="chk-<?php echo e($listing->id); ?>"
                                       class="form-check-input row-tic tic-check" name="check" value="<?php echo e($listing->id); ?>"
                                       data-id="<?php echo e($listing->id); ?>"
                                       data-listing = "<?php echo e($listing->title); ?>"
                                >
                                <label for="chk-<?php echo e($listing->id); ?>"></label>
                            </td>
                            <?php endif; ?>

                            <td data-label="<?php echo app('translator')->get('No.'); ?>"><?php echo e(loopIndex($all_user_listings) + $loop->index); ?></td>

                            <td data-label="<?php echo app('translator')->get('User'); ?>">
                                <div class="float-left">
                                    <a href="<?php echo e(route('admin.user-edit', optional($listing->get_user)->id)); ?>" target="_blank">
                                        <img src="<?php echo e(getFile(optional($listing->get_user)->driver, optional($listing->get_user)->image)); ?>" alt="<?php echo e(config('basic.site_title')); ?>" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    <?php echo app('translator')->get(optional($listing->get_user)->firstname); ?> <?php echo app('translator')->get(optional($listing->get_user)->lastname); ?> <br>
                                    <?php echo app('translator')->get(optional($listing->get_user)->email); ?>
                                </div>

                            </td>

                            <td data-label="<?php echo app('translator')->get('package'); ?>"><?php echo app('translator')->get(optional(optional($listing->get_package)->get_package)->title); ?></td>
                            <td data-label="<?php echo app('translator')->get('listing'); ?>">
                                <a href="<?php echo e(route('listing-details',[slug($listing->title), $listing->id])); ?>" target="_blank">
                                    <?php echo app('translator')->get(\Illuminate\Support\Str::limit($listing->title, 20)); ?>
                                </a>

                            </td>

                            <td data-label="<?php echo app('translator')->get('category'); ?>">
                                <?php echo e($listing->getCategoriesName()); ?>

                            </td>
                            <td data-label="<?php echo app('translator')->get('address'); ?>"><?php echo app('translator')->get(\Illuminate\Support\Str::limit($listing->address, 20)); ?></td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>" class="text-center">
                                <span class="badge badge-pill
                                    <?php if($listing->status == 0): ?>
                                        badge-danger
                                    <?php elseif($listing->status == 1): ?>
                                        badge-success
                                    <?php else: ?>
                                        badge-warning
                                    <?php endif; ?> ">

                                    <?php if($listing->status == 0): ?>
                                        <?php echo app('translator')->get('Pending'); ?>
                                    <?php elseif($listing->status == 1): ?>
                                        <?php echo app('translator')->get('Approved'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('Rejected'); ?>
                                    <?php endif; ?>
                                </span>
                                <?php if($listing->status == 2): ?>
                                    <sup>
                                        <a href="javascript:void(0)"
                                           title="<?php echo app('translator')->get('Rejected Reason'); ?>"
                                           data-owner="<?php echo app('translator')->get(optional($listing->get_user)->firstname); ?> <?php echo app('translator')->get(optional($listing->get_user)->lastname); ?>"
                                           data-title="<?php echo e($listing->title); ?>"
                                           data-rejectedreason="<?php echo e($listing->rejected_reason); ?>"
                                           data-deactivereason="<?php echo e($listing->deactive_reason); ?>"
                                           class="info-listing-btn listingRejectedInfo" aria-labelledby="dropdownMenuLink">  <i class="fas fa-info"></i>
                                        </a>
                                    </sup>
                                <?php endif; ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Stage'); ?>" class="text-center">

                                    <span class="badge badge-pill
                                        <?php if($listing->is_active == 0): ?>
                                            badge-danger
                                        <?php else: ?>
                                             badge-success
                                        <?php endif; ?> ">

                                        <?php if($listing->is_active == 0): ?>
                                            <?php echo app('translator')->get('Deactive'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('Active'); ?>
                                        <?php endif; ?>
                                    </span>
                                <?php if($listing->is_active == 0): ?>
                                    <sup>
                                        <a href="javascript:void(0)"
                                           data-owner="<?php echo app('translator')->get(optional($listing->get_user)->firstname); ?> <?php echo app('translator')->get(optional($listing->get_user)->lastname); ?>"
                                           data-title="<?php echo e($listing->title); ?>"
                                           data-deactivereason="<?php echo e($listing->deactive_reason); ?>"
                                           class="info-listing-btn listingDeactiveInfo" aria-labelledby="dropdownMenuLink">  <i class="fas fa-info"></i>
                                        </a>
                                    </sup>
                                <?php endif; ?>
                            </td>
                            <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true || adminAccessRoute(config('role.manage_listing.access.delete')) == true): ?>
                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <div class="dropdown show ">

                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <?php if(adminAccessRoute(config('role.manage_listing.access.edit')) == true): ?>
                                            <?php if($listing->status == 0): ?>
                                                <button class="dropdown-item singleApproved" type="button" data-toggle="modal"
                                                        data-target="#single_approved" data-id="<?php echo e($listing->id); ?>"> <i class="fas fa-check pr-2"></i> <?php echo app('translator')->get('Approved'); ?>
                                                </button>
                                                <button class="dropdown-item singleRejected" type="button" data-toggle="modal"
                                                        data-target="#single_rejected" data-id="<?php echo e($listing->id); ?>"> <i class="fas fa-times pr-2"></i> <?php echo app('translator')->get('Rejected'); ?>
                                                </button>
                                            <?php endif; ?>
                                            <a
                                               <?php if($listing->is_active == 0): ?>
                                                    class="dropdown-item activeDeactiveListing listingActive"
                                                    data-id="<?php echo e($listing->id); ?>"
                                                    data-title="<?php echo e($listing->title); ?>"
                                               <?php else: ?>
                                                   class="dropdown-item activeDeactiveListing listingDeactive"
                                                   data-id="<?php echo e($listing->id); ?>"
                                                   data-title="<?php echo e($listing->title); ?>"
                                               <?php endif; ?> ">

                                                <?php if($listing->is_active == 0): ?>
                                                    <i class="fa fa-toggle-off pr-2"></i> <?php echo app('translator')->get('Active'); ?>
                                                <?php else: ?>
                                                    <i class="fa fa-toggle-on pr-2"></i> <?php echo app('translator')->get('Deactive'); ?>
                                                <?php endif; ?>
                                            </a>
                                            <a href="<?php echo e(route('admin.listingAnalytics', $listing->id)); ?>"
                                               class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-chart-line pr-2"></i> <?php echo app('translator')->get('Analytics'); ?>
                                            </a>
                                            <a href="<?php echo e(route('admin.listingReview', $listing->id)); ?>"
                                               class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fas fa-star pr-2"></i> <?php echo app('translator')->get('Reviews'); ?>
                                            </a>
                                            <?php if($listing->is_active == 0 || $listing->status == 2): ?>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('admin.editListing', $listing->id)); ?>"
                                                   class="dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fa fa-edit pr-2"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(adminAccessRoute(config('role.manage_listing.access.delete')) == true): ?>
                                            <a href="javascript:void(0)"
                                               data-route="<?php echo e(route('admin.viewListingDelete', $listing->id)); ?>"
                                               data-toggle="modal"
                                               data-target="#delete-modal"
                                               class="notiflix-confirm dropdown-item" aria-labelledby="dropdownMenuLink"><i class="fa fa-trash-alt pr-2"></i> <?php echo app('translator')->get('Delete'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td class="text-center text-danger" colspan="100%"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>

                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($all_user_listings->appends(@$search)->links('partials.pagination')); ?>

            </div>
        </div>
    </div>

    <?php $__env->startPush('adminModal'); ?>
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><span class="messageShow"></span> <?php echo app('translator')->get('Confirmation'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" class="deleteRoute">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <div class="modal-body">
                            <p class="font-weight-bold"><?php echo app('translator')->get('Are you sure delete message?'); ?> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <button type="submit" class="btn waves-effect waves-light btn-primary messageShow"> <?php echo app('translator')->get('Delete'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="activeListingModal" class="modal fade" tabindex="-1" role="dialog"
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

        <!-- Active Listing Modal -->
        <div id="listingActiveModal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Active Confirmation'); ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="showListingTitle"> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="<?php echo e(route('admin.listingActive')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="" class="listingActiveId" name="listing_id">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deactive Listing Modal -->
        <div class="modal fade" id="listingDeactiveModal" role="dialog">
            <div class="modal-dialog">
                <form action="<?php echo e(route('admin.listingDeactive')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title"><?php echo app('translator')->get('Deactive Listing Confirmation'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <p class="showListingTitle"></p>

                            <div class="form-group">
                                <label for=""><?php echo app('translator')->get('Write you reason'); ?></label> <span class="text-danger">*</span>
                                <input type="hidden" value="" name="listing_id" class="listingDeactiveId">
                                <textarea name="deactive_reason" id="deactive_reason" required rows="4" class="form-control <?php $__errorArgs = ['deactive_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo app('translator')->get('type here...'); ?>"></textarea>
                                <div class="invalid-feedback">
                                    <?php $__errorArgs = ['deactive_reason'];
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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>

                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listing Deactive Info Modal -->
        <div class="modal fade" id="listingDeactiveInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('Listing Information'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item listingOwner"></li>
                                <li class="list-group-item listingTitle"></li>
                                <li class="list-group-item deactiveReason"></li>
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

        <!-- Listing Rejected Info Modal -->
        <div class="modal fade" id="listingRejectedInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('Listing Information'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item listingOwner"></li>
                                <li class="list-group-item listingTitle"></li>
                                <li class="list-group-item rejectedReason"></li>
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

        <div class="modal fade" id="single_approved" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><?php echo app('translator')->get('Approved Listing Confirmation'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get("Are you really want to approved this Listing?"); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                        <form>
                            <button type="button" class="btn btn-primary approved-yes"><span><?php echo app('translator')->get('Yes'); ?></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="single_rejected" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><?php echo app('translator')->get('Rejected Listing Confirmation'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get("Are you really want to Rejected this Listing?"); ?></p>
                        <div class="form-group">
                            <label for=""><?php echo app('translator')->get('Write you reason'); ?></label> <span class="text-danger">*</span>
                            <textarea name="single_reject_reason" id="single_reject_reason" rows="4" class="form-control" placeholder="<?php echo app('translator')->get('type here...'); ?>"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                        <form>
                            <button type="button" class="btn btn-primary rejected-yes"><span><?php echo app('translator')->get('Yes'); ?></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="all_active" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><?php echo app('translator')->get('Approved Listing Confirmation'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get("Are you really want to approved the Listing?"); ?></p>
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
                <form action="" method="post">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title"><?php echo app('translator')->get('Rejected Listing Confirmation'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <p><?php echo app('translator')->get("Are you really want to rejected the Listing?"); ?></p>
                            <div class="form-group">
                                <label for=""><?php echo app('translator')->get('Write you reason'); ?></label> <span class="text-danger">*</span>
                                <textarea name="reject_reason" id="reject_reason" rows="4" class="form-control" placeholder="<?php echo app('translator')->get('type here...'); ?>"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>
                                <?php echo csrf_field(); ?>
                                <a href="javascript:void(0)"  class="btn btn-primary inactive-yes"><span><?php echo app('translator')->get('Yes'); ?></span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        "use strict";
            $(document).on('click', '.listingActive', function () {
                var showListingActiveModal = new bootstrap.Modal(document.getElementById('listingActiveModal'))
                showListingActiveModal.show();
                let listingId = $(this).data('id');
                let listingTitle = $(this).data('title');
                $('.showListingTitle').text(`<?php echo app('translator')->get('Are you sure to active '); ?> ${listingTitle} <?php echo app('translator')->get(' Listing?'); ?>`);
                $('.listingActiveId').val(listingId);
            });

            $(document).on('click', '.listingDeactive', function () {
                var showlistingDeactiveModal = new bootstrap.Modal(document.getElementById('listingDeactiveModal'))
                showlistingDeactiveModal.show();

                let listingId = $(this).data('id');
                let listingTitle = $(this).data('title');
                $('.showListingTitle').text(`<?php echo app('translator')->get('Are you sure to deactive '); ?> ${listingTitle} <?php echo app('translator')->get(' Listing?'); ?>`);
                $('.listingDeactiveId').val(listingId);
            });

            $(document).on('click', '.listingDeactiveInfo', function () {
                var showlistingDeactiveInfoModal = new bootstrap.Modal(document.getElementById('listingDeactiveInfoModal'))
                showlistingDeactiveInfoModal.show();

                let listingOwner = $(this).data('owner');
                let listingTitle = $(this).data('title');
                let deactiveReason = $(this).data('deactivereason');

                $('.listingOwner').text(`<?php echo app('translator')->get('Owner: '); ?> ${listingOwner}`);
                $('.listingTitle').text(`<?php echo app('translator')->get('Listing: '); ?> ${listingTitle}`);
                $('.deactiveReason').text(`<?php echo app('translator')->get('Deactive Reason: '); ?> ${deactiveReason}`);
            });

            $(document).on('click', '.listingRejectedInfo', function () {
                var showlistingRejectedInfoModal = new bootstrap.Modal(document.getElementById('listingRejectedInfoModal'))
                showlistingRejectedInfoModal.show();

                let listingOwner = $(this).data('owner');
                let listingTitle = $(this).data('title');
                let rejectedReason = $(this).data('rejectedreason');

                $('.listingOwner').text(`<?php echo app('translator')->get('Owner: '); ?> ${listingOwner}`);
                $('.listingTitle').text(`<?php echo app('translator')->get('Listing: '); ?> ${listingTitle}`);
                $('.rejectedReason').text(`<?php echo app('translator')->get('Rejected Reason: '); ?> ${rejectedReason}`);
            });
    </script>

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

            $('select').select2({
                selectOnClose: true
            });
        });
    </script>

    <script>
        "use strict";

        $(document).on('click', '#check-all', function () {
            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '<?php echo app('translator')->get("Select Categories"); ?>',
            });
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

        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //Single Approved
        $(document).on('click', '.approved-yes', function (e) {
            var listingId = $('.singleApproved').data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.listingSingleApproved')); ?>",
                data: {
                    listingId: listingId,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //Single Rejected
        $(document).on('click', '.rejected-yes', function (e) {
            var listingId = $('.singleRejected').data('id');
            var rejectReason = $('#single_reject_reason').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.listingSingleRejected')); ?>",
                data: {
                    listingId: listingId,
                    rejectReason: rejectReason,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //multiple Approved
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            var listing = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
                listing.push($(this).attr('data-listing'));
            });

            var strIds = allVals;
            var userListing = listing;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.listing-multiple-approved')); ?>",
                data: {
                    strIds: strIds,
                    userListing: userListing,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                },
            });
        });

        //multiple Rejected
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            var listing = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
                listing.push($(this).attr('data-listing'));
            });

            var strIds = allVals;
            var rejectReason = $('#reject_reason').val();
            var userListing = listing;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('admin.listing-multiple-rejected')); ?>",
                data: {
                    strIds: strIds,
                    rejectReason: rejectReason,
                    userListing: userListing,
                },
                datatType: 'json',
                type: "POST",
                success: function (data) {
                    location.reload();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/listing/viewListing.blade.php ENDPATH**/ ?>