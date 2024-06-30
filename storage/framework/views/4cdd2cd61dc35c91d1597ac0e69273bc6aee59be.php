
<?php $__env->startSection('title',trans('All Listing')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><?php echo app('translator')->get('Data Anggota'); ?></h3>
                </div>

                <!-- <div class="switcher">
                    <a href="<?php echo e(route('user.allListing')); ?>">
                        <button class="<?php if(lastUriSegment() == 'listings'): ?> active <?php endif; ?>"><?php echo app('translator')->get('Listings'); ?></button>
                    </a>
                    <a href="<?php echo e(route('user.allListing', 'pending')); ?>">
                        <button class="<?php echo e((lastUriSegment() == 'pending') ? 'active' : ''); ?>"><?php echo app('translator')->get('Pending'); ?></button>
                    </a>
                    <a href="<?php echo e(route('user.allListing', 'approved')); ?>">
                        <button class="<?php echo e((lastUriSegment() == 'approved') ? 'active' : ''); ?>"> <?php echo app('translator')->get('Approved'); ?></button>
                    </a>
                    <a href="<?php echo e(route('user.allListing', 'rejected')); ?>">
                        <button class="<?php echo e((lastUriSegment() == 'rejected') ? 'active' : ''); ?>"><?php echo app('translator')->get('Rejected'); ?></button>
                    </a>
                </div> -->

                <!-- search area -->
                <div class="search-bar" id="listing-search-bar">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo app('translator')->get('Search Anggota'); ?>" value="<?php echo e(old('name',request()->name)); ?>"/>
                                </div>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <select class="js-example-basic-single form-control" name="package">
                                    <option value="" selected disabled><?php echo app('translator')->get('Pilih Jenis'); ?></option>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($package->id); ?>" <?php echo e(request()->package == $package->id ? 'selected' : ''); ?>><?php echo app('translator')->get(optional($package->details)->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <!-- <select class="listing__category__select2 form-control" name="category[]" multiple> -->
                                <select class="listing__category__select2 form-control" name="category[]">
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

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <select
                                    class="js-example-basic-single form-control"
                                    name="location">
                                    <option value="" selected disabled><?php echo app('translator')->get('Enter Location'); ?></option>
                                    <?php $__currentLoopData = $allAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($address->id); ?>" <?php echo e(request()->location == $address->id ? 'selected' : ''); ?>><?php echo app('translator')->get(optional($address->details)->place); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <button class="btn btn-sm btn-primary mr-2" type="submit"><?php echo app('translator')->get('search'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-secondary mr-2 add-listing-button-custom notiflix-confirm" data-bs-toggle="modal" data-bs-target="#addListingmodal">
                        <i class="fal fa-plus" aria-hidden="true"></i> <?php echo app('translator')->get('Add Listing'); ?>
                    </button>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive listing-table-parent">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Unit'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Jenis Usaha'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Judul'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Location'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Stage'); ?></th>
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
                                    <a href="<?php echo e(route('listing-details',[slug($item->title), $item->id])); ?>"
                                       target="_blank">
                                        <?php echo app('translator')->get($item->title); ?>
                                    </a>
                                </td>

                                <td data-label="Location">
                                    <?php echo app('translator')->get($item->address); ?>
                                </td>

                                <td data-label="Stage">
                                    <?php if($item->status == 1): ?>
                                        <span class="badge rounded-pill bg-success"><?php echo app('translator')->get('Approved'); ?></span>
                                    <?php elseif($item->status == 2): ?>
                                        <span class="badge rounded-pill bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-info"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td data-label="Status">
                                    <?php if($item->is_active == 0): ?>
                                        <span class="badge rounded-pill bg-danger"><?php echo app('translator')->get('Deactive'); ?></span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-success"><?php echo app('translator')->get('Active'); ?></span>
                                    <?php endif; ?>
                                </td>


                                <?php if($item->status == 2): ?>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <div class="dropdown-btns">
                                            <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn currentColor notiflix-confirm dropdown-item" data-route="<?php echo e(route('admin.listingDelete', $item->id)); ?>">
                                                        <i class="far fa-trash-alt me-2"></i> <?php echo app('translator')->get('Delete'); ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                <?php else: ?>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <div class="dropdown-btns">
                                            <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- <li>
                                                    <a href="<?php echo e(route('user.analytics', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                        <i class="fal fa-analytics me-2"></i> <?php echo app('translator')->get('Analytics'); ?>
                                                    </a>
                                                </li> -->
                                                <!-- <li>
                                                    <a href="<?php echo e(route('user.reviews', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                        <i class="far fa-star me-2"></i> <?php echo app('translator')->get('Reviews'); ?>
                                                    </a>
                                                </li> -->
                                                <li>
                                                    <a href="<?php echo e(route('admin.editListing', $item->id)); ?>" class="btn currentColor dropdown-item">
                                                        <i class="far fa-edit me-2"></i> <?php echo app('translator')->get('Edit'); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn currentColor notiflix-confirm dropdown-item" data-route="<?php echo e(route('admin.listingDelete', $item->id)); ?>">
                                                        <i class="far fa-trash-alt me-2"></i> <?php echo app('translator')->get('Delete'); ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td class="text-center" colspan="100%"> <?php echo app('translator')->get('No Data Found'); ?></td>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($user_listings->appends($_GET)->links()); ?>

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

        <div class="modal fade" id="addListingmodal" tabindex="-1" aria-labelledby="addListingmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title text-white" id="editModalLabel"><?php echo app('translator')->get('Create Listing'); ?></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="package" class="col-form-label"><?php echo app('translator')->get('Package'); ?></label>
                                <select name="package" id="package" class="form-control">
                                    <option selected disabled><?php echo app('translator')->get('Select Package'); ?></option>
                                    <?php $__currentLoopData = $my_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php
                                    echo $package;
                                        $fundInfo = \App\Models\Fund::where('purchase_package_id', $package->id)->latest()->first();
                                        // print($fundInfo); //
                                        ?>
                                        <?php if(($package->no_of_listing > 0 || $package->no_of_listing == null) && ($package->expire_date == null ||  \Carbon\Carbon::now() <= \Carbon\Carbon::parse($package->expire_date)) && ($package->status == 1)): ?>
                                            <option value="<?php echo e($package->id); ?>" data-listing="<?php echo e($package->no_of_listing); ?>" data-route="<?php echo e(route('admin.addListing', $package->id)); ?>" class="total_listing<?php echo e($package->id); ?>"><?php echo app('translator')->get(optional($package->get_package)->title); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="mb-3 d-none" id="noOfListing">
                                <label for="message-text" class="col-form-label"><?php echo app('translator')->get('No. of available listing'); ?></label>
                                <input type="text" class="form-control total_no_of_listing_field" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <a href="javascript:void(0)"  class="btn btn-primary addCreateListingRoute"><?php echo app('translator')->get('Create'); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>

    <?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script>
        'use strict'
        $(document).ready(function () {

            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '<?php echo app('translator')->get("Select Categories"); ?>',
            });

            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })

            $('#package').on('change', function () {
                console.log('test');
                $('#noOfListing').removeClass('d-none');
                let package_id = $(this).val();
                let no_of_listing = $('.total_listing' + package_id).data('listing');
                console.log(no_of_listing);
                if (no_of_listing) {
                    $('.total_no_of_listing_field').val(no_of_listing);
                } else {
                    $('.total_no_of_listing_field').val('Unlimited');
                }

                let route = $('.total_listing' + package_id).data('route');
                $('.addCreateListingRoute').attr('href', route)

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/listing/listing.blade.php ENDPATH**/ ?>