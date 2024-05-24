<!-- Cookie Alert -->
<?php if(getCookieInfo() != false): ?>
    <!-- Cookie-content -->
    <div id="cookieAlert" class="cookie-content d-none">
        <div class="content">
            <img class="cookie-img" src="<?php echo e(asset($themeTrue.'img/cookie.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>">
            <h5 class="title cookie-title"><?php echo app('translator')->get(optional(getCookieInfo()->description)->title); ?></h5>
            <p>
                <?php echo app('translator')->get(Str::limit(optional(getCookieInfo()->description)->popup_short_description, 180)); ?>
                <a href="<?php echo e(route('getTemplate', ['cookie-consent'])); ?>" class="text--base"><?php echo app('translator')->get('Privacy Policy'); ?></a>
            </p>
            <div class="cookie-btns">
                <a href="javascript:void(0)" class="close-btn" id="cookie-deny"><?php echo app('translator')->get('Decline'); ?></a>
                <a href="javascript:void(0)" class="cmn--btn btn-sm btn--success btn-custom"
                   id="cookie-accept"><?php echo app('translator')->get('Accept'); ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'
        if (localStorage.getItem('cookie-value') == 1 || sessionStorage.getItem('cookie-value') == 1) {
            $('.cookie-content').remove();
        } else {
            $('.cookie-content').removeClass('d-none');
        }

        $('#cookie-accept').on("click", function () {
            localStorage.setItem('cookie-value', 1);
            sessionStorage.removeItem('cookie-value');
            $('.cookie-content').remove();
        });

        $('#cookie-deny').on("click", function () {
            sessionStorage.setItem('cookie-value', 1);
            localStorage.removeItem('cookie-value');
            $('.cookie-content').remove();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/cookie.blade.php ENDPATH**/ ?>