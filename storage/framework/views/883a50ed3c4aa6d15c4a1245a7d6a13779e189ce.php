<!-- FOOTER -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-box">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.logo_image'))); ?>" alt="<?php echo e(config('basic.site_title')); ?>">
                    </a>
                    <?php if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0]): ?>
                        <p>
                            <?php echo app('translator')->get(strip_tags(optional($contact->description)->footer_short_details)); ?>
                        </p>
                    <?php endif; ?>
                    <?php if(isset($contentDetails['social'])): ?>
                        <div class="social-links">
                            <?php $__currentLoopData = $contentDetails['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(optional(optional(optional($data->content)->contentMedia)->description)->link); ?>" target="_blank">
                                    <i class="<?php echo e(optional(optional(optional($data->content)->contentMedia)->description)->icon); ?>"></i>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ps-lg-5">
                <div class="footer-box">
                    <h5><?php echo app('translator')->get('Quick Links'); ?></h5>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('About'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('listing')); ?>"><?php echo app('translator')->get('Listing'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ps-lg-5">
                <div class="footer-box">
                    <h5><?php echo app('translator')->get('OUR Services'); ?></h5>
                    <ul>
                        <?php if(isset($contentDetails['support'])): ?>
                            <?php $__currentLoopData = $contentDetails['support']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('getLink', [slug(optional($data->description)->title), $data->content_id])); ?>"><?php echo app('translator')->get(optional($data->description)->title); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQ'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0]): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-box">
                        <h5><?php echo app('translator')->get('get in touch'); ?></h5>
                        <ul>
                            <li>
                                <i class="far fa-phone-alt"></i>
                                <span><?php echo app('translator')->get(optional($contact->description)->phone); ?></span>
                            </li>
                            <li>
                                <i class="far fa-envelope"></i>
                                <span><?php echo app('translator')->get(optional($contact->description)->email); ?></span>
                            </li>
                            <li>
                                <i class="far fa-map-marker-alt"></i>
                                <span><?php echo app('translator')->get(optional($contact->description)->address); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">
                        <?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?> <a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get($basic->site_title); ?></a> <?php echo app('translator')->get('All Rights Reserved'); ?>
                    </p>
                </div>

                <?php
                    $languageArray = json_decode($languages, true);
                ?>

                <div class="col-md-6 language">
                    <?php $__currentLoopData = $languageArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('language',$key)); ?>"><span class="flag-icon flag-icon-<?php echo e(strtolower($key)); ?>"></span><?php echo app('translator')->get($lang); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /FOOTER -->


<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/footer.blade.php ENDPATH**/ ?>