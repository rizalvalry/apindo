<!-- sidebar -->
<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(getFile(config('basic.default_file_driver'),config('basic.logo_image'))); ?>" alt="<?php echo e(config('basic.site_title')); ?>"/>
        </a>
        <button
            class="sidebar-toggler d-lg-none"
            onclick="toggleSideMenu()">
            <i class="fal fa-times"></i>
        </button>
    </div>
    <ul class="main tabScroll">
        <li>
            <a class="<?php echo e((lastUriSegment() == 'dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('user.home')); ?>"
            ><i class="fal fa-th-large text-success"></i><?php echo app('translator')->get('Dashboard'); ?></a>
        </li>


        <li>
            <a href="<?php echo e(route('user.myPackages')); ?>" class="<?php echo e((lastUriSegment() == 'packages') ? 'active' : ''); ?>">
                <i class="fal fa-box-full text-primary"></i><?php echo app('translator')->get('My Packages'); ?>
            </a>
        </li>

        <li>
            <?php
                $id = '';
            ?>
            <a href="<?php echo e(route('user.allListing')); ?>"
               class="<?php echo e((lastUriSegment() == 'listings' || lastUriSegment() == 'pending' || lastUriSegment() == 'approved' || lastUriSegment() == 'rejected') ? 'active' : ''); ?>">
                <i class="fal fa-list-ol text-orange"></i><?php echo app('translator')->get('My Listings'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.wishList')); ?>" class="<?php echo e((lastUriSegment() == 'wish-list') ? 'active' : ''); ?>">
                <i class="fal fa-heart text-cyan"></i> <?php echo app('translator')->get('WishList'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.productQuery', 'customer-enquiry')); ?>"
               class="<?php echo e((lastUriSegment() == 'customer-enquiry' || lastUriSegment() == 'my-enquiry') ? 'active' : ''); ?>">
                <i class="fal fa-question text-orange"></i> <?php echo app('translator')->get('Product Enquiry'); ?>
                <?php if($customerEnquiry > 0 || $myEnquiry > 0): ?>

                    <sup class="text-danger custom__queiry_count"> <span
                            class="badge bg-primary rounded-circle"><?php echo e($customerEnquiry + $myEnquiry); ?></span> </sup>
                <?php endif; ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.transaction')); ?>" class="<?php echo e((lastUriSegment() == 'transaction') ? 'active' : ''); ?>">
                <i class="fal fa-sack-dollar text-pink"></i><?php echo app('translator')->get('Transaction'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.analytics')); ?>" class="<?php echo e((lastUriSegment() == 'analytics') ? 'active' : ''); ?>">

                <i class="fal fa-analytics text-green"></i><?php echo app('translator')->get('Analytics'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.profile')); ?>" class="<?php echo e((lastUriSegment() == 'profile') ? 'active' : ''); ?>">
                <i class="fal fa-users-cog text-indigo"></i> <?php echo app('translator')->get('Profile Settings'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.ticket.list')); ?>" class="<?php echo e((lastUriSegment() == 'ticket') ? 'active' : ''); ?>">
                <i class="fal fa-user-headset text-success"></i> <?php echo app('translator')->get('support ticket'); ?>
            </a>
        </li>

        <li class="">
            <a href="<?php echo e(route('user.twostep.security')); ?>">
                <i class="fal fa-lock text-orange"></i> <?php echo app('translator')->get('2FA Security'); ?>
            </a>
        </li>

        <li class="">
            <a href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fal fa-sign-out-alt text-purple"></i> <?php echo app('translator')->get('Sign Out'); ?>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </a>
        </li>

    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/user/sidebar.blade.php ENDPATH**/ ?>