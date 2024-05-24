<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <?php if(adminAccessRoute(config('role.dashboard.access.view'))): ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>" aria-expanded="false">
                            <i data-feather="home" class="feather-icon text-blue"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Dashboard'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.manage_role.access.view'))): ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.staff')); ?>" aria-expanded="false">
                            <i data-feather="users" class="feather-icon text-cyan"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Role Permission'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.identify_form.access.view'))): ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.identify-form')); ?>" aria-expanded="false">
                            <i data-feather="file-text" class="feather-icon text-danger"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('KYC / Identity Form'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.manage_package.access.view'))): ?>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Manage Package'); ?></span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.package')); ?>" aria-expanded="false">
                                <i class="fa fa-th text-green" aria-hidden="true"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Package List'); ?></span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.purchasePackageList')); ?>">
                                <i class="fa fa-shopping-cart text-indigo" aria-hidden="true" title="Purchase Package History"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Purchase History'); ?></span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                    <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.manage_listing.access.view'))): ?>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Manage Listing'); ?></span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.listingCategory')); ?>" aria-expanded="false">
                            <i class="fa fa-crosshairs text-primary" aria-hidden="true"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Category'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.viewListings')); ?>" aria-expanded="false">
                            <i class="fa fa-list-ol text-cyan" aria-hidden="true"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('User Listings'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.wishList')); ?>" aria-expanded="false">
                            <i class="fa fa-heart text-info" aria-hidden="true"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('WishList'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.productEnquiry')); ?>" aria-expanded="false">
                            <i class="fa fa-question text-danger" aria-hidden="true"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Product Enquiry'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.listingAnalytics')); ?>" aria-expanded="false">
                            <i class="fas fa-chart-line text-warning"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Analytics'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.listingSettings')); ?>" aria-expanded="false">
                            <i class="fa fa-cog text-orange" aria-hidden="true"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Settings'); ?></span>
                        </a>
                    </li>

                    <li class="list-divider"></li>
                    <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.amenities.access.view'))): ?>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Amenities'); ?></span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.amenities')); ?>" aria-expanded="false">
                                <i class="fa fa-check-circle text-pink" aria-hidden="true"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Amenities List'); ?></span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                    <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.place.access.view'))): ?>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Place'); ?></span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.place')); ?>" aria-expanded="false">
                                <i class="fa fa-location-arrow text-purple" aria-hidden="true"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Place List'); ?></span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                    <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.claim_business.access.view'))): ?>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Claim Business'); ?></span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.claimBusiness')); ?>" aria-expanded="false">
                                <i class="fa fa-thumbs-down text-green" aria-hidden="true"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Claim List'); ?></span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                    <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.contact_message.access.view'))): ?>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Listing Message'); ?></span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.contactMessage')); ?>" aria-expanded="false">
                                <i class="fas fa-envelope-open text-yellow"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Message List'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php if(adminAccessRoute(config('role.manage_user.access.view'))): ?>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Manage User'); ?></span></li>

                        <li class="sidebar-item <?php echo e(menuActive(['admin.users','admin.users.search','admin.user-edit*','admin.send-email*','admin.user*'],3)); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.users')); ?>" aria-expanded="false">
                                <i class="fas fa-users text-indigo"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('All User'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.kyc.users.pending')); ?>"
                               aria-expanded="false">
                                <i class="fas fa-spinner text-cyan"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Pending KYC'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.kyc.users')); ?>"
                               aria-expanded="false">
                                <i class="fas fa-file text-success"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('KYC Log'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.email-send')); ?>"
                               aria-expanded="false">
                                <i class="fas fa-envelope-open text-pink"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Send Email'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>



                <?php if(adminAccessRoute(config('role.all_transaction.access.view'))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('All Transaction '); ?></span></li>

                    <li class="sidebar-item <?php echo e(menuActive(['admin.transaction*'],3)); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.transaction')); ?>" aria-expanded="false">
                            <i class="fas fa-exchange-alt text-cyan"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Transaction'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.payment_gateway.access.view'))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Payment Settings'); ?></span></li>
                    <li class="sidebar-item <?php echo e(menuActive(['admin.payment.methods','admin.edit.payment.methods'],3)); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.payment.methods')); ?>"
                           aria-expanded="false">
                            <i class="fas fa-credit-card text-orange"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Payment Methods'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php echo e(menuActive(['admin.deposit.manual.index','admin.deposit.manual.create','admin.deposit.manual.edit'],3)); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.deposit.manual.index')); ?>"
                           aria-expanded="false">
                            <i class="fa fa-university text-pink"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Manual Gateway'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.payment_log.access.view'))): ?>
                    <li class="sidebar-item <?php echo e(menuActive(['admin.payment.pending'],3)); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.payment.pending')); ?>" aria-expanded="false">
                            <i class="fas fa-spinner text-info"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Payment Request'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item <?php echo e(menuActive(['admin.payment.log','admin.payment.search'],3)); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.payment.log')); ?>" aria-expanded="false">
                            <i class="fas fa-history text-green"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Payment Log'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.subscriber.access.view'))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Subscriber'); ?></span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.subscriber.index')); ?>" aria-expanded="false">
                            <i class="fas fa-envelope-open text-pink"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Subscriber List'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.support_ticket.access.view'))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Support Tickets'); ?></span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.ticket')); ?>" aria-expanded="false">
                            <i class="fas fa-ticket-alt text-blue"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('All Tickets'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.ticket',['open'])); ?>"
                           aria-expanded="false">
                            <i class="fas fa-spinner text-primary"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Open Ticket'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.ticket',['closed'])); ?>"
                           aria-expanded="false">
                            <i class="fas fa-times-circle text-danger"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Closed Ticket'); ?></span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.ticket',['answered'])); ?>"
                           aria-expanded="false">
                            <i class="fas fa-reply text-success"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Answered Ticket'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(adminAccessRoute(array_merge(config('role.website_controls.access.view'), config('role.language_settings.access.view')))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Controls'); ?></span></li>

                    <?php if(adminAccessRoute(config('role.website_controls.access.view'))): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.basic-controls')); ?>" aria-expanded="false">
                                <i class="fas fa-cogs text-purple"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Basic Controls'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.fileStorage')); ?>" aria-expanded="false">
                                <i class="fa fa-database text-warning"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('File Storage'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.plugin.config')); ?>" aria-expanded="false">
                                <i class="fa fa-plug text-teal" aria-hidden="true"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Plugin Configuration'); ?></span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-envelope text-primary"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Email Settings'); ?></span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.email-controls')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Email Controls'); ?></span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.email-template.show')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Email Template'); ?> </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-mobile-alt text-green"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('SMS Settings'); ?></span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.sms.config')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('SMS Controls'); ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.sms-template')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('SMS Template'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-bell text-pink"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Push Notification'); ?></span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.notify-config')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Configuration'); ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.notify-template.show')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Template'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(adminAccessRoute(config('role.language_settings.access.view'))): ?>
                        <li class="sidebar-item <?php echo e(menuActive(['admin.language.create','admin.language.edit*','admin.language.keywordEdit*'],3)); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.language.index')); ?>"
                               aria-expanded="false">
                                <i class="fas fa-language text-indigo"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Manage Language'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(adminAccessRoute(config('role.theme_settings.access.view'))): ?>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Theme Settings'); ?></span></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.logo-seo')); ?>" aria-expanded="false">
                            <i class="fas fa-image text-pink"></i><span
                                class="hide-menu"><?php echo app('translator')->get('Manage Logo & SEO'); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('admin.breadcrumb')); ?>" aria-expanded="false">
                            <i class="fas fa-file-image text-primary"></i><span
                                class="hide-menu"><?php echo app('translator')->get('Manage Breadcrumb'); ?></span>
                        </a>
                    </li>


                    <li class="sidebar-item <?php echo e(menuActive(['admin.template.show*'],3)); ?>">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-clipboard-list text-success"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Section Heading'); ?></span>
                        </a>
                        <ul aria-expanded="false"
                            class="collapse first-level base-level-line <?php echo e(menuActive(['admin.template.show*'],1)); ?>">

                            <?php $__currentLoopData = array_diff(array_keys(config('templates')),['message','template_media']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="sidebar-item <?php echo e(menuActive(['admin.template.show'.$name])); ?>">
                                    <a class="sidebar-link <?php echo e(menuActive(['admin.template.show'.$name])); ?>"
                                       href="<?php echo e(route('admin.template.show',$name)); ?>">
                                        <span class="hide-menu"><?php echo app('translator')->get(ucfirst(kebab2Title($name))); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </li>

                    <?php
                        $segments = request()->segments();
                        $last  = end($segments);
                    ?>
                    <li class="sidebar-item <?php echo e(menuActive(['admin.content.create','admin.content.show*'],3)); ?>">
                        <a class="sidebar-link has-arrow <?php echo e(Request::routeIs('admin.content.show',$last) ? 'active' : ''); ?>"
                           href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-clipboard-list text-primary"></i>
                            <span class="hide-menu"><?php echo app('translator')->get('Content Settings'); ?></span>
                        </a>
                        <ul aria-expanded="false"
                            class="collapse first-level base-level-line <?php echo e(menuActive(['admin.content.create','admin.content.show*'],1)); ?>">
                            <?php $__currentLoopData = array_diff(array_keys(config('contents')),['message','content_media']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="sidebar-item <?php echo e(($last == $name) ? 'active' : ''); ?> ">
                                    <a class="sidebar-link <?php echo e(($last == $name) ? 'active' : ''); ?>"
                                       href="<?php echo e(route('admin.content.index',$name)); ?>">
                                        <span class="hide-menu"><?php echo app('translator')->get(ucfirst(kebab2Title($name))); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

                    <?php if(adminAccessRoute(config('role.manage_blog.access.view'))): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-book text-orange"></i>
                                <span class="hide-menu"><?php echo app('translator')->get('Manage Blog'); ?></span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.blogCategory')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Blog Category'); ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo e(route('admin.blogList')); ?>" class="sidebar-link">
                                        <span class="hide-menu"><?php echo app('translator')->get('Blog List'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu"><?php echo app('translator')->get('Version 3.0'); ?></span></li>
            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>