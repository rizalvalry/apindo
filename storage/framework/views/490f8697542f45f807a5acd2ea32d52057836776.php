<?php $__env->startSection('title',trans('Pricing')); ?>

<?php $__env->startSection('banner_heading'); ?>
    <?php echo app('translator')->get('Pricing plan'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(count($Packages) > 0): ?>
        <section class="pricing-section">
            <div class="container">
                <?php if(isset($templates['package'][0]) && $package = $templates['package'][0]): ?>
                    <div class="row">
                        <div class="col">
                            <div class="header-text text-center mb-5">
                                <h2><?php echo app('translator')->get(optional($package->description)->title); ?></h2>
                                <p class="mx-auto">
                                    <?php echo app('translator')->get(strip_tags(optional($package->description)->short_details)); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row gy-3 g-md-5">
                    <?php $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="box">
                                <div class="icon-box">
                                    <img src="<?php echo e(getFile($item->driver, $item->image)); ?>"
                                         alt="<?php echo e(config('basic.site_title')); ?>" width="64"/>
                                </div>

                                <div class="text-box">
                                    <h5><?php echo app('translator')->get(optional($item->details)->title); ?></h5>
                                    <h3>
                                        <?php if($item->price == null): ?>
                                            <?php echo e($basic->currency_symbol ?? '$'); ?><?php echo app('translator')->get('0'); ?>
                                        <?php else: ?>
                                            <?php echo e($basic->currency_symbol ?? '$'); ?><?php echo e($item->price); ?>

                                        <?php endif; ?>
                                    </h3>
                                    <ul>
                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->expiry_time < 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Package expiry'); ?></span>
                                            <span
                                                class="float-end"><?php if($item->expiry_time != null): ?> <?php echo e($item->expiry_time); ?> <?php echo e($item->expiry_time_type); ?> <?php else: ?> <?php echo app('translator')->get('Unlimited'); ?> <?php endif; ?> </span>
                                        </li>

                                        <li>
                                            <span><i class="fal fa-check-circle text-primary"></i><?php echo app('translator')->get('No of Listing'); ?></span>
                                            <span
                                                class="float-end"><?php echo e($item->no_of_listing == null ? 'Unlimited' : $item->no_of_listing); ?></span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_image == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('No of images per listing'); ?></span>
                                            <span
                                                class="float-end"> <?php if($item->is_image == 0 ): ?> <?php echo app('translator')->get('No'); ?> <?php elseif($item->is_image == 1 && $item->no_of_img_per_listing == null): ?> <?php echo app('translator')->get('Unlimited'); ?> <?php else: ?> <?php echo e($item->no_of_img_per_listing); ?> <?php endif; ?> </span>
                                        </li>

                                        <li>
                                            <span><i class="fal fa-check-circle text-primary"></i><?php echo app('translator')->get('No of categories per listing'); ?>
                                            </span>
                                            <span class="float-end"> <?php echo e($item->no_of_categories_per_listing); ?> </span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_product == 1 ? 'fal fa-check-circle text-primary' : 'fal fa-times-circle text-danger'); ?>"></i><?php echo app('translator')->get('Products'); ?></span>
                                            <span class="float-end"><?php echo e($item->is_product == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_product == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('No of Product'); ?></span>
                                            <span class="float-end">
                                               <span
                                                   class="float-end"> <?php if($item->is_product == 0): ?> <?php echo app('translator')->get('No'); ?> <?php elseif($item->is_product == 1 && $item->no_of_product == null): ?> <?php echo app('translator')->get('Unlimited'); ?> <?php else: ?> <?php echo e($item->no_of_product); ?> <?php endif; ?> </span>
                                            </span>
                                        </li>

                                        <li>
                                             <span>
                                                <i class="<?php echo e($item->is_product == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('No of images per product'); ?>
                                             </span>
                                            <span class="float-end"> <span
                                                    class="float-end"> <?php if($item->is_product == 0): ?> <?php echo app('translator')->get('No'); ?> <?php elseif($item->is_product == 1 && $item->no_of_img_per_product == null): ?> <?php echo app('translator')->get('Unlimited'); ?> <?php else: ?> <?php echo e($item->no_of_img_per_product); ?> <?php endif; ?> </span></span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_video == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Video'); ?></span>
                                            <span class="float-end"><?php echo e($item->is_video == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_amenities == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Amenities'); ?></span>
                                            <span class="float-end"><?php echo e($item->is_amenities == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span><i
                                                    class="<?php echo e($item->is_amenities == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('No of amenities per listing'); ?></span>
                                            <span
                                                class="float-end"> <?php if($item->is_amenities == 0): ?> <?php echo app('translator')->get('No'); ?> <?php elseif($item->is_amenities == 1 && $item->no_of_amenities_per_listing == null): ?> <?php echo app('translator')->get('Unlimited'); ?> <?php else: ?> <?php echo e($item->no_of_amenities_per_listing); ?> <?php endif; ?> </span>
                                        </li>

                                        <li>
                                            <span> <i
                                                    class="<?php echo e($item->is_business_hour == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Business Hour'); ?></span>
                                            <span
                                                class="float-end"><?php echo e($item->is_business_hour == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span> <i
                                                    class="<?php echo e($item->seo == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('SEO'); ?></span>
                                            <span class="float-end"><?php echo e($item->seo == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span> <i
                                                    class="<?php echo e($item->is_whatsapp == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Messenger chat SDK'); ?></span>
                                            <span class="float-end"><?php echo e($item->is_whatsapp == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span> <i
                                                    class="<?php echo e($item->is_whatsapp == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Whatsapp chat SDK'); ?></span>
                                            <span class="float-end"><?php echo e($item->is_whatsapp == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>

                                        <li>
                                            <span> <i
                                                    class="<?php echo e($item->is_renew == 0 ? 'fal fa-times-circle text-danger' : 'fal fa-check-circle text-primary'); ?>"></i><?php echo app('translator')->get('Package Renew'); ?></span>
                                            <span class="float-end"><?php echo e($item->seo == 1 ? 'Yes' : 'No'); ?></span>
                                        </li>
                                    </ul>

                                    <?php if($item->price == null): ?>
                                        <button type="button" class="btn btn-primary btn-custom w-50 choosePlan <?php echo e($item->isFreePurchase() == 'true' ? 'disabled' : ''); ?>"
                                                data-route="<?php echo e(route('user.make-payment', $item->id)); ?>"
                                                data-price="<?php echo e(($item->price == null ? 0 : $item->price)); ?>"
                                                data-plan="<?php echo e(optional($item->details)->title); ?>"
                                                data-listing="<?php echo e($item->no_of_listing); ?>"
                                                data-expiretime="<?php echo e($item->expiry_time); ?>"
                                                data-expiretype="<?php echo e($item->expiry_time_type); ?>">
                                            <?php echo e($item->isFreePurchase() == 'true' ? __('Already Purchased') : __('Start Free')); ?>

                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary btn-custom choosePlan"
                                                data-route="<?php echo e(route('user.make-payment', $item->id)); ?>"
                                                data-price="<?php echo e($item->price); ?>"
                                                data-plan="<?php echo e(optional($item->details)->title); ?>"
                                                data-listing="<?php echo e($item->no_of_listing); ?>"
                                                data-expiretime="<?php echo e($item->expiry_time); ?>"
                                                data-expiretype="<?php echo e($item->expiry_time_type); ?>">
                                            <?php echo app('translator')->get('choose plan'); ?>
                                        </button>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__env->startPush('frontend_modal'); ?>
                        <form class="plan-modal-form purchasePackageForm" id="plan-modal-form" action=""
                              method="get" enctype="multipart/form-data">
                            <div class="modal fade" id="choosePlanModal" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title plan-name"
                                                id="exampleModalLabel"><?php echo app('translator')->get('Purchase Plan Information'); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body ">
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto"><?php echo app('translator')->get('Price'); ?></div>
                                                    <span class="plan-price"> </span>
                                                </li>
                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto"><?php echo app('translator')->get('No. Of Listing'); ?></div>
                                                    <span class="plan-listing"></span>
                                                </li>
                                                <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto"><?php echo app('translator')->get('Validity'); ?></div>
                                                    <span class="package-validity"></span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                    class="btn btn-primary d-block w-100 purchasePackageSubmitBtn"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php $__env->stopPush(); ?>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="custom-not-found2">
            <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>"
                 class="img-fluid">
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.choosePlan', function () {
                var planModal = new bootstrap.Modal(document.getElementById('choosePlanModal'))
                planModal.show()

                let dataRoute = $(this).data('route');
                let plan_name = $(this).data('plan');
                let symbol = "<?php echo e(trans($basic->currency_symbol)); ?>";
                let price = $(this).data('price');
                let listing = $(this).data('listing');

                let plan_expire_time = $(this).data('expiretime');
                let plan_expire_type = $(this).data('expiretype');
                let packageValidity = plan_expire_time + ' ' + plan_expire_type;

                if (price == 0){
                    $('.purchasePackageSubmitBtn').text('Start Free Trial')
                }else{
                    $('.purchasePackageSubmitBtn').text('Purchase Now')
                }

                $('.plan-name').text(plan_name);
                $('.plan-price').text(`${symbol}${price}`);

                $('.purchasePackageForm').attr('action', dataRoute);

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

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/pricing.blade.php ENDPATH**/ ?>