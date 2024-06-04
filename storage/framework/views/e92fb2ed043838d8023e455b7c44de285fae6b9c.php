<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.favicon_image'))); ?>">
    <title><?php echo app('translator')->get($basic->site_title); ?> | <?php echo $__env->yieldContent('title'); ?></title>

    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link href="<?php echo e(asset('assets/admin/css/bootstrap4-toggle.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/all.min.css')); ?>"/>

    <!-- <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>" /> -->

    <link href="<?php echo e(asset('assets/admin/css/style.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/admin/css/custom.css')); ?>" rel="stylesheet">

    <!-- <?php echo $__env->yieldPushContent('style'); ?> -->

    <!-- milik users -->
    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/bootstrap5.min.css')); ?>"/>

    <!-- jquery ui -->
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/jquery-ui.css')); ?>"/>

    <!-- radial progress -->
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/radialprogress.css')); ?>"/>

    <!-- select 2 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/select2.min.css')); ?>"/>

    <!-- leaflet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/esri-leaflet-geocoder.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet-search.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/Control.FullScreen.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/owl.carousel.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/owl.theme.default.min.css')); ?>" />

    <!-- font awesome 5 -->
    <script src="<?php echo e(asset('assets/global/js/fontawesomepro.js')); ?>"></script>


    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/leaflet-search-two.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/user-style.css')); ?>"/>

    <?php echo $__env->yieldPushContent('css-lib'); ?>
    <?php echo $__env->yieldPushContent('style'); ?>
    <!----  Push your custom css  ----->
    <!-- users end -->


</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $__env->yieldContent('title'); ?></h4>

                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo app('translator')->get('Dashboard'); ?></li>
                                <li class="breadcrumb-item text-muted" aria-current="page"><?php echo $__env->yieldContent('title'); ?></li>
                            </ol>
                        </nav>
                    </div>

                </div>

            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->yieldPushContent('adminModal'); ?>


        <footer class="footer text-center text-muted">
            <?php echo e(trans('Copyrights')); ?> © <?php echo e(date('Y')); ?> <?php echo app('translator')->get('All Rights Reserved By'); ?> <?php echo app('translator')->get($basic->site_title); ?>
        </footer>

    </div>
</div>


<?php echo $__env->yieldPushContent('loadModal'); ?>

<?php echo $__env->yieldPushContent('extra-content'); ?>

<!-- milik users -->
<!-- bootstrap 5-->
<script src="<?php echo e(asset('assets/global/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- jquery cdn -->
<script src="<?php echo e(asset('assets/global/js/jquery.min.js')); ?>"></script>
<!-- jquery ui -->
<script src="<?php echo e(asset($themeTrue.'js/jquery-ui.js')); ?>"></script>

<!-- radial progress -->
<script src="<?php echo e(asset($themeTrue.'js/radialprogress.js')); ?>"></script>

<!-- select 2 -->
<script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>

<!-- leaflet -->
<script src="<?php echo e(asset('assets/global/js/leaflet.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/Control.FullScreen.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/esri-leaflet.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/leaflet-search.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/esri-leaflet-geocoder.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/bootstrap-geocoder.js')); ?>"></script>

<script src="<?php echo e(asset('assets/global/js/notiflix-aio-2.7.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/pusher.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/vue.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/axios.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/owl.carousel.min.js')); ?>"></script>
<!-- custom script -->
<!-- end users -->

<script src="<?php echo e(asset('assets/global/js/jquery.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/global/js/popper.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>


<script src="<?php echo e(asset('assets/admin/js/bootstrap4-toggle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/app-style-switcher.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/notiflix-aio-2.7.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/perfect-scrollbar.jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/sidebarmenu.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/admin-mart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/custom.js')); ?>"></script>
<?php echo $__env->make('admin.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('assets/global/js/axios.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/vue.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/pusher.min.js')); ?>"></script>

<?php echo $__env->yieldPushContent('extra-js'); ?>

<script src="<?php echo e(asset('assets/themes/classic/js/user-script.js')); ?>"></script>


<?php echo $__env->yieldPushContent('script'); ?>

<script>
    'use strict';
    let pushNotificationArea = new Vue({
        el: "#pushNotificationArea",
        data: {
            items: [],
        },
        beforeMount() {
            this.getNotifications();
            this.pushNewItem();
        },
        methods: {
            getNotifications() {
                let app = this;
                axios.get("<?php echo e(route('admin.push.notification.show')); ?>")
                    .then(function (res) {
                        app.items = res.data;
                    })
            },
            readAt(id, link) {
                let app = this;
                let url = "<?php echo e(route('admin.push.notification.readAt', 0)); ?>";
                url = url.replace(/.$/, id);
                axios.get(url)
                    .then(function (res) {
                        if (res.status) {
                            app.getNotifications();
                            if (link != '#') {
                                window.location.href = link
                            }
                        }
                    })
            },
            readAll() {
                let app = this;
                let url = "<?php echo e(route('admin.push.notification.readAll')); ?>";
                axios.get(url)
                    .then(function (res) {
                        if (res.status) {
                            app.items = [];
                        }
                    })
            },
            pushNewItem() {
                let app = this;
                // Pusher.logToConsole = true;
                let pusher = new Pusher("<?php echo e(env('PUSHER_APP_KEY')); ?>", {
                    encrypted: true,
                    cluster: "<?php echo e(env('PUSHER_APP_CLUSTER')); ?>"
                });
                let channel = pusher.subscribe('admin-notification.' + "<?php echo e(Auth::guard('admin')->id()); ?>");
                channel.bind('App\\Events\\AdminNotification', function (data) {
                    app.items.unshift(data.message);
                });
                channel.bind('App\\Events\\UpdateAdminNotification', function (data) {
                    app.getNotifications();
                });
            }
        }
    });
</script>
<?php echo $__env->make($theme.'partials.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>