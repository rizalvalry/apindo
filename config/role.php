<?php

$arr = [
    'dashboard' => [
        'label' => "Dashboard",
        'access' => [
            'view' => ['admin.dashboard'],
            'add' => [],
            'edit' => [],
            'delete' => [],
        ],
    ],
    'manage_role' =>[
        'label' => "Role Permission",
        'access' => [
            'view' => ['admin.staff'],
            'add' => ['admin.storeStaff'],
            'edit' => ['admin.updateStaff'],
            'delete' => [],
        ],
    ],
    'identify_form' =>[
        'label' => "KYC / Identity Form",
        'access' => [
            'view' => ['admin.identify-form'],
            'add' => [],
            'edit' => [
                'admin.identify-form.store',
                'admin.identify-form.action'
            ],
            'delete' => [],
        ],
    ],
    'manage_user' => [
        'label' => "Manage User",
        'access' => [
            'view' => [
                'admin.users',
                'admin.user-multiple-active',
                'admin.user-multiple-inactive',
                'admin.user-edit',
                'admin.email-send',
                'admin.kyc.users.pending',
                'admin.kyc.kyc.users',
            ],
            'add' => ['admin.email-send.store'],
            'edit' => [
                'admin.user-update',
                'admin.userPasswordUpdate',
                'admin.userKycHistory',
                'admin.send-email',
                'admin.login-as-user',
                'admin.users.Kyc.action',
            ],
            'delete' => [],
        ],
    ],
    'manage_package' => [
        'label' => "Manage Package",
        'access' => [
            'view' => [
                'admin.package',
                'admin.purchasePackageList',
            ],
            'add' => [
                'admin.packageCreate'
            ],
            'edit' => [
                'admin.packageEdit',
            ],
            'delete' => [
                'admin.packageDelete',
                'admin.userPurchasePackageDelete'
            ],
        ],
    ],
    'manage_listing' => [
        'label' => "Manage Listing",
        'access' => [
            'view' => [
                'admin.listingCategory',
                'admin.viewListings',
                'admin.listingSettings',
                'admin.wishList',
                'admin.productEnquiry',
                'admin.listingAnalytics',
                'admin.showListingAnalytics',
                'admin.listingReview',
            ],
            'add' => [
                'admin.listingCategoryCreate'
            ],
            'edit' => [
                'admin.listingCategoryEdit',
                'admin.editListing',
            ],
            'delete' => [
                'admin.listingCategoryDelete',
                'admin.viewListingDelete',
                'admin.wishListDelete',
                'admin.listingReviewDelete',
                'admin.listingAnalyticsDelete',
            ],
        ],
    ],
    'amenities' => [
        'label' => "Amenities",
        'access' => [
            'view' => [
                'admin.amenities',
            ],
            'add' => [
                'admin.amenitiesCreate'
            ],
            'edit' => [
                'admin.amenitiesEdit',
            ],
            'delete' => [
                'admin.amenitiesDelete',
            ],
        ],
    ],
    'place' => [
        'label' => "place",
        'access' => [
            'view' => [
                'admin.place',
            ],
            'add' => [
                'admin.placeCreate'
            ],
            'edit' => [
                'admin.placeEdit',
            ],
            'delete' => [
                'admin.placeDelete',
            ],
        ],
    ],
    'claim_business' => [
        'label' => "Claim Business",
        'access' => [
            'view' => [
                'admin.claimBusiness',
            ],
            'add' => [],
            'edit' => [],
            'delete' => [
                'admin.claimMessageDelete',
            ],
        ],
    ],
    'contact_message' => [
        'label' => "Contact Message",
        'access' => [
            'view' => [
                'admin.contactMessage',
            ],
            'add' => [],
            'edit' => [],
            'delete' => [
                'admin.contactMessageDelete',
            ],
        ],
    ],
    'all_transaction' => [
        'label' => "All Transaction",
        'access' => [
            'view' => [
                'admin.transaction',
                'admin.transaction.search',
            ],
            'add' => [],
            'edit' => [],
            'delete' => [],
        ],
    ],
    'subscriber' => [
        'label' => "Subscriber",
        'access' => [
            'view' => [
                'admin.subscriber.index',
                'admin.subscriber.sendEmail',
            ],
            'add' => [],
            'edit' => [],
            'delete' => [
                'admin.subscriber.remove'
            ],
        ],
    ],
    'payment_gateway' => [
        'label' => "Payment Gateway",
        'access' => [
            'view' => [
                'admin.payment.methods',
                'admin.deposit.manual.index',
            ],
            'add' => [
                'admin.deposit.manual.create'
            ],
            'edit' => [
                'admin.edit.payment.methods',
                'admin.deposit.manual.edit'
            ],
            'delete' => [],
        ],
    ],

    'payment_log' => [
        'label' => "Payment Request & Log",
        'access' => [
            'view' => [
                'admin.payment.pending',
                'admin.payment.log',
                'admin.payment.search',
            ],
            'add' => [],
            'edit' => [
                'admin.payment.action'
            ],
            'delete' => [],
        ],
    ],


    'support_ticket' => [
        'label' => "Support Ticket",
        'access' => [
            'view' => [
                'admin.ticket',
                'admin.ticket.view',
            ],
            'add' => [
                'admin.ticket.reply'
            ],
            'edit' => [],
            'delete' => [
                'admin.ticket.delete',
            ],
        ],
    ],
    'website_controls' => [
        'label' => "Website Controls",
        'access' => [
            'view' => [
                'admin.basic-controls',
                'admin.email-controls',
                'admin.email-template.show',
                'admin.sms.config',
                'admin.sms-template',
                'admin.notify-config',
                'admin.notify-template.show',
                'admin.notify-template.edit',
            ],
            'add' => [],
            'edit' => [
                'admin.basic-controls.update',
                'admin.email-controls.update',
                'admin.email-template.edit',
                'admin.sms-template.edit',
                'admin.notify-config.update',
                'admin.notify-template.update',
            ],
            'delete' => [],
        ],
    ],
    'language_settings' => [
        'label' => "Language Settings",
        'access' => [
            'view' => [
                'admin.language.index',
            ],
            'add' => [
                'admin.language.create',
            ],
            'edit' => [
                'admin.language.edit',
                'admin.language.keywordEdit',
            ],
            'delete' => [
                'admin.language.delete'
            ],
        ],
    ],
    'theme_settings' =>  [
        'label' => "Theme Settings",
        'access' => [
            'view' => [
                'admin.manage.theme',
                'admin.logo-seo',
                'admin.breadcrumb',
                'admin.template.show',
                'admin.content.index',
            ],
            'add' => [
                'admin.content.create'
            ],
            'edit' => [
                'admin.logoUpdate',
                'admin.seoUpdate',
                'admin.breadcrumbUpdate',
                'admin.content.show',
            ],
            'delete' => [
                'admin.content.delete'
            ],
        ],
    ],
    'manage_blog' =>  [
        'label' => "Manage Blog",
        'access' => [
            'view' => [
                'admin.blogCategory',
                'admin.blogList',
            ],
            'add' => [
                'admin.blogCategoryCreate',
                'admin.blogCreate',
            ],
            'edit' => [
                'admin.blogCategoryEdit',
                'admin.blogEdit',
            ],
            'delete' => [
                'admin.blogCategoryDelete',
                'admin.blogDelete',
            ],
        ],
    ],

];

return $arr;



