<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" <?php if(session()->get('rtl') == 1): ?> dir="rtl" <?php endif; ?> >
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <title><?php echo $__env->yieldContent('title'); ?></title>

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
    <!----  Push your custom css  ----->
    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body <?php if(session()->get('rtl') == 1): ?> class="rtl" <?php endif; ?> >

<div class="dashboard-wrapper">

    <?php echo $__env->make($theme.'partials.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- content -->
    <div id="content">
        <div class="overlay">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand d-lg-none d-none" href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.logo_image'))); ?>"
                             alt="<?php echo e(config('basic.site_title')); ?>">
                    </a>

                    <button class="sidebar-toggler" onclick="toggleSideMenu()">
                        <i class="fal fa-bars"></i>
                    </button>

                    <span class="navbar-text">
                    <!-- notification panel -->
                    <?php echo $__env->make($theme.'partials.pushNotify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <!-- user panel -->
                    <div class="user-panel">
                       <span class="profile">
                          <img
                              src="<?php echo e(getFile(Auth::user()->driver, Auth::user()->image)); ?>"
                              class="img-fluid"
                              alt="<?php echo e(config('basic.site_title')); ?>"
                          />
                       </span>
                       <ul class="user-dropdown">
                           <li>
                                <a href="<?php echo e(route('user.home')); ?>">
                                    <i class="fal fa-border-all"></i> <?php echo e(trans('Dashboard')); ?>

                                </a>
                            </li>

                          <li>
                             <a href="<?php echo e(route('user.profile')); ?>">
                                <i class="fal fa-user"></i> <?php echo app('translator')->get('Profile'); ?>
                             </a>
                          </li>

                           <li>
                                <a href="<?php echo e(route('user.twostep.security')); ?>">
                                    <i class="fal fa-lock"></i> <?php echo app('translator')->get('2FA Security'); ?>
                                </a>
                            </li>

                          <li>
                             <a href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fal fa-sign-out-alt"></i> <?php echo app('translator')->get('Sign Out'); ?>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                   <?php echo csrf_field(); ?>
                               </form>
                             </a>
                          </li>
                       </ul>
                    </div>
                 </span>
                </div>
            </nav>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

</div>

<?php echo $__env->yieldPushContent('loadModal'); ?>

<?php echo $__env->yieldPushContent('extra-content'); ?>
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


<?php echo $__env->yieldPushContent('extra-js'); ?>

<!-- custom script -->
<script src="<?php echo e(asset($themeTrue.'js/user-script.js')); ?>"></script>

<?php if(auth()->guard()->check()): ?>
<script>
    'use strict';
    $(".card-boxes").owlCarousel({
        loop: true,
        margin: -25,
        rtl: false,
        nav: false,
        dots: false,
        autoplay: false,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
        },
    });

    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>;
    var module = {};

    let pushNotificationArea = new Vue({
        el: "#pushNotificationArea",
        data: {
            items: [],
        },
        mounted() {
            this.getNotifications();
            this.pushNewItem();
        },
        methods: {
            getNotifications() {
                let app = this;
                axios.get("<?php echo e(route('user.push.notification.show')); ?>")
                    .then(function (res) {
                        app.items = res.data;
                    })
            },
            readAt(id, link) {
                let app = this;
                let url = "<?php echo e(route('user.push.notification.readAt', 0)); ?>";
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
                let url = "<?php echo e(route('user.push.notification.readAll')); ?>";
                axios.get(url)
                    .then(function (res) {
                        if (res.status) {
                            app.items = [];
                        }
                    })
            },
            pushNewItem() {
                let app = this;
                let pusher = new Pusher("<?php echo e(env('PUSHER_APP_KEY')); ?>", {
                    encrypted: true,
                    cluster: "<?php echo e(env('PUSHER_APP_CLUSTER')); ?>"
                });
                let channel = pusher.subscribe('user-notification.' + "<?php echo e(Auth::id()); ?>");
                channel.bind('App\\Events\\UserNotification', function (data) {
                    app.items.unshift(data.message);
                });
                channel.bind('App\\Events\\UpdateUserNotification', function (data) {
                    app.getNotifications();
                });
            }
        }
    });
</script>
<?php endif; ?>
<?php echo $__env->yieldPushContent('script'); ?>

<?php echo $__env->make($theme.'partials.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/layouts/user.blade.php ENDPATH**/ ?>