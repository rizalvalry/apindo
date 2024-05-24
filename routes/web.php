<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\FileStorageController;

Route::get('/clear', function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('optimize:clear', array(), $output);
    return $output->fetch();
})->name('/clear');

Route::get('/user', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/loginModal', 'Auth\LoginController@loginModal')->name('loginModal');

Route::get('queue-work', function () {
    return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
})->name('queue.work');

Route::get('sql-update', function () {
    return Illuminate\Support\Facades\Artisan::call('sql:update');
})->name('sql-update');

Route::get('migrate', function () {
    return Illuminate\Support\Facades\Artisan::call('migrate');
})->name('migrate');

Route::get('cron', function () {
        return Illuminate\Support\Facades\Artisan::call('expiryDate:cron');
})->name('cron');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['guest']], function () {
    Route::get('register/{sponsor?}', 'Auth\RegisterController@sponsor')->name('register.sponsor');
});

Route::group(['middleware' => ['auth', 'Maintenance'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/check', 'User\VerificationController@check')->name('check');
    Route::get('/resend_code', 'User\VerificationController@resendCode')->name('resendCode');
    Route::post('/mail-verify', 'User\VerificationController@mailVerify')->name('mailVerify');
    Route::post('/sms-verify', 'User\VerificationController@smsVerify')->name('smsVerify');
    Route::post('twoFA-Verify', 'User\VerificationController@twoFAverify')->name('twoFA-Verify');
    Route::middleware('userCheck')->group(function () {

        Route::middleware('kyc')->group(function () {
            Route::get('/change-password', 'User\HomeController@changePassIndex')->name('changePassword');
            Route::post('/updatePassword', 'User\HomeController@updatePassword')->name('updatePassword');
            Route::get('/dashboard', 'User\HomeController@index')->name('home');
            Route::get('/calender', 'User\HomeController@calender')->name('calender');

            Route::post('/send-review', 'User\ReviewController@sendReview')->name('sendReview');
            Route::post('/send-listing-message/{id}', 'User\SendMailController@sendListingMessage')->name('sendListingMessage');

            //Review
            Route::post('/listing-details/review', 'FrontendController@reviewPush')->name('review.push');
            Route::get('categories', 'FrontendController@reviewPaginate');

            Route::post('/send-product-query', 'User\SendMailController@sendProductQuery')->name('sendProductQuery');
            Route::get('/product-enquiry/{type?}', 'User\ProductController@productQuery')->name('productQuery');
            Route::delete('/product-query-delete/{id?}', 'User\ProductController@productQueryDelete')->name('productQueryDelete');
            Route::get('/product-query-reply/{id?}', 'User\ProductController@productQueryReply')->name('productQueryReply');
            Route::post('/product/reply/message', 'User\ProductController@productReplyMessage')->name('productReplyMessage');
            Route::post('/product/reply/message/render/', 'User\ProductController@productReplyMessageRender')->name('productReplyMessageRender');;

            Route::post('/viewer-send-message-to-listing-user/{id}', 'User\SendMailController@viewerSendMessageToListingUser')->name('viewerSendMessageToListingUser');

            Route::post('/claim-business/{id}', 'User\SendMailController@claimBusiness')->name('claimBusiness');

            Route::post('/wish-list', 'User\FavouriteController@wishList')->name('wishList');
            Route::post('reomove-wish-list', 'User\FavouriteController@reomoveWishList')->name('reomoveWishList');

            Route::post('/follow/{id?}', 'User\FollowerController@follow')->name('follow');
            Route::post('/un-follow/{id?}', 'User\FollowerController@unFollow')->name('unFollow');


            // user purchace plan
            Route::post('/purchase-plan', 'User\PricingController@purchacePlan')->name('purchase-plan');
            Route::get('/make-payment/{id}', 'User\PricingController@makePayment')->name('make-payment');
            Route::post('/make-payment-details', 'User\PricingController@makePaymentDetails')->name('makePaymentDetails');

            Route::get('payment-history/{id?}', 'User\PricingController@paymentHistory')->name('paymentHistory');
            Route::get('/renew-package/{id}', 'User\PricingController@renewPackage')->name('renewPackage');
            Route::post('/renew-package-update', 'User\PricingController@renewPackageUpdate')->name('renewPackageUpdate');


            Route::delete('purchase-package-delete/{id?}', 'User\PricingController@purchasePackageDelete')->name('purchasePackageDelete');

            // Listing
            Route::get('listings/{type?}', 'User\ListingController@listing')->name('allListing');
            Route::get('/wish-list', 'User\ListingController@wishList')->name('wishList');

            Route::delete('/favourite-listings-delete/{id?}', 'User\ListingController@favouriteListingDelete')->name('favouriteListingDelete');

            Route::get('add-listing/{id?}', 'User\ListingController@addListing')->name('addListing');

            Route::get('edit-listing/{id}', 'User\ListingController@editListing')->name('editListing');
            Route::post('listing-store/{id}', 'User\ListingController@listingStore')->name('listingStore');
            Route::post('listing-update/{id}', 'User\ListingController@listingUpdate')->name('listingUpdate');
            Route::delete('listing-delete/{id}', 'User\ListingController@listingDelete')->name('listingDelete');


            Route::get('payment', 'User\HomeController@addFund')->name('addFund');
            Route::post('payment', 'PaymentController@addFundRequest')->name('addFund.request');
            Route::get('addFundConfirm', 'PaymentController@depositConfirm')->name('addFund.confirm');
            Route::post('addFundConfirm', 'PaymentController@fromSubmit')->name('addFund.fromSubmit');

            // my packages
            Route::get('packages/{id?}', 'User\PricingController@myPackages')->name('myPackages');

            //transaction
            Route::get('/transaction', 'User\HomeController@transaction')->name('transaction');
            Route::get('/transaction-search', 'User\HomeController@transactionSearch')->name('transaction.search');
            Route::get('fund-history', 'User\HomeController@fundHistory')->name('fund-history');
            Route::get('fund-history-search', 'User\HomeController@fundHistorySearch')->name('fund-history.search');

            //Analytics
            Route::get('/analytics/{id?}', 'User\AnalyticsController@analytics')->name('analytics');
            Route::get('/reviews/{id?}', 'User\ListingController@reviews')->name('reviews');
            Route::get('/show/listing/analytics/{id?}', 'User\AnalyticsController@showListingAnalytics')->name('showListingAnalytics');


            Route::get('/transaction-search', 'User\HomeController@transactionSearch')->name('transaction.search');
            Route::get('fund-history', 'User\HomeController@fundHistory')->name('fund-history');
            Route::get('fund-history-search', 'User\HomeController@fundHistorySearch')->name('fund-history.search');


            // TWO-FACTOR SECURITY
            Route::get('/twostep-security', 'User\HomeController@twoStepSecurity')->name('twostep.security');
            Route::post('twoStep-enable', 'User\HomeController@twoStepEnable')->name('twoStepEnable');
            Route::post('twoStep-disable', 'User\HomeController@twoStepDisable')->name('twoStepDisable');


            Route::get('push-notification-show', 'SiteNotificationController@show')->name('push.notification.show');
            Route::get('push.notification.readAll', 'SiteNotificationController@readAll')->name('push.notification.readAll');
            Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');

        });

        // User Profile
        Route::get('/profile', 'User\ProfileController@profile')->name('profile');
        Route::post('/profileUpdate/{id}', 'User\ProfileController@profileUpdate')->name('profileUpdate');
        Route::post('/profileImageUpdate', 'User\ProfileController@profileImageUpdate')->name('profileImageUpdate');
        Route::post('/coverPhotoUpdate', 'User\ProfileController@coverPhotoUpdate')->name('coverPhotoUpdate');
        Route::put('/updateInformation', 'User\ProfileController@updateInformation')->name('updateInformation');
        Route::post('/updatePassword', 'User\ProfileController@updatePassword')->name('updatePassword');

        Route::post('/verificationSubmit', 'User\ProfileController@verificationSubmit')->name('verificationSubmit');
        Route::post('/addressVerification', 'User\ProfileController@addressVerification')->name('addressVerification');


        Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
            Route::get('/', 'User\SupportController@index')->name('list');
            Route::get('/create', 'User\SupportController@create')->name('create');
            Route::post('/create', 'User\SupportController@store')->name('store');
            Route::get('/view/{ticket}', 'User\SupportController@ticketView')->name('view');
            Route::put('/reply/{ticket}', 'User\SupportController@reply')->name('reply');
            Route::get('/download/{ticket}', 'User\SupportController@download')->name('download');
        });
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Admin\LoginController@login')->name('login');
    Route::post('/logout', 'Admin\LoginController@logout')->name('logout');
    Route::post('/admin/login/as/user/{id}', 'Admin\UsersController@loginAsUser')->name('login-as-user');

    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.update');


    Route::get('/403', 'Admin\DashboardController@forbidden')->name('403');

    Route::group(['middleware' => ['auth:admin', 'permission']], function () {
        Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
        Route::get('/calender', 'Admin\DashboardController@calender')->name('calender');

        Route::get('/profile', 'Admin\DashboardController@profile')->name('profile');
        Route::put('/profile', 'Admin\DashboardController@profileUpdate')->name('profileUpdate');
        Route::get('/password', 'Admin\DashboardController@password')->name('password');
        Route::put('/password', 'Admin\DashboardController@passwordUpdate')->name('passwordUpdate');


        Route::get('/role-permission', 'Admin\ManageRolePermissionController@staff')->name('staff');
        Route::post('/role-permission', 'Admin\ManageRolePermissionController@storeStaff')->name('storeStaff');
        Route::put('/role-permission/{id}', 'Admin\ManageRolePermissionController@updateStaff')->name('updateStaff');

        Route::get('/identity-form', 'Admin\IdentyVerifyFromController@index')->name('identify-form');
        Route::post('/identity-form', 'Admin\IdentyVerifyFromController@store')->name('identify-form.store');
        Route::post('/identity-form/action', 'Admin\IdentyVerifyFromController@action')->name('identify-form.action');


        /* ====== Transaction Log =====*/
        Route::get('/transaction', 'Admin\LogController@transaction')->name('transaction');
        Route::get('/transaction-search', 'Admin\LogController@transactionSearch')->name('transaction.search');


        /*====Manage Users ====*/
        Route::get('/users', 'Admin\UsersController@index')->name('users');
        Route::get('/users/search', 'Admin\UsersController@search')->name('users.search');
        Route::post('/users-active', 'Admin\UsersController@activeMultiple')->name('user-multiple-active');
        Route::post('/users-inactive', 'Admin\UsersController@inactiveMultiple')->name('user-multiple-inactive');
        Route::get('/user/edit/{id?}', 'Admin\UsersController@userEdit')->name('user-edit');
        Route::post('/user/update/{id}', 'Admin\UsersController@userUpdate')->name('user-update');
        Route::post('/user/password/{id}', 'Admin\UsersController@passwordUpdate')->name('userPasswordUpdate');
        Route::post('/user/balance-update/{id}', 'Admin\UsersController@userBalanceUpdate')->name('user-balance-update');

        Route::get('/user/send-email/{id}', 'Admin\UsersController@sendEmail')->name('send-email');
        Route::post('/user/send-email/{id}', 'Admin\UsersController@sendMailUser')->name('user.email-send');
        Route::get('/user/transaction/{id}', 'Admin\UsersController@transaction')->name('user.transaction');
        Route::get('/user/fundLog/{id}', 'Admin\UsersController@funds')->name('user.fundLog');
        Route::get('/user/payoutLog/{id}', 'Admin\UsersController@payoutLog')->name('user.withdrawal');
        Route::get('/user/referralMember/{id}', 'Admin\UsersController@referralMember')->name('user.referralMember');

        Route::get('users/kyc/pending', 'Admin\UsersController@kycPendingList')->name('kyc.users.pending');
        Route::get('users/kyc', 'Admin\UsersController@kycList')->name('kyc.users');
        Route::put('users/kycAction/{id}', 'Admin\UsersController@kycAction')->name('users.Kyc.action');
        Route::get('user/{user}/kyc', 'Admin\UsersController@userKycHistory')->name('user.userKycHistory');

        Route::get('/email-send', 'Admin\UsersController@emailToUsers')->name('email-send');
        Route::post('/email-send', 'Admin\UsersController@sendEmailToUsers')->name('email-send.store');


        /*=====Payment Log=====*/
        Route::get('payment-methods', 'Admin\PaymentMethodController@index')->name('payment.methods');
        Route::post('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
        Route::get('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
        Route::post('sort-payment-methods', 'Admin\PaymentMethodController@sortPaymentMethods')->name('sort.payment.methods');
        Route::get('payment-methods/edit/{id}', 'Admin\PaymentMethodController@edit')->name('edit.payment.methods');
        Route::put('payment-methods/update/{id}', 'Admin\PaymentMethodController@update')->name('update.payment.methods');

        // Manual Methods
        Route::get('payment-methods/manual', 'Admin\ManualGatewayController@index')->name('deposit.manual.index');
        Route::get('payment-methods/manual/new', 'Admin\ManualGatewayController@create')->name('deposit.manual.create');
        Route::post('payment-methods/manual/new', 'Admin\ManualGatewayController@store')->name('deposit.manual.store');
        Route::get('payment-methods/manual/edit/{id}', 'Admin\ManualGatewayController@edit')->name('deposit.manual.edit');
        Route::put('payment-methods/manual/update/{id}', 'Admin\ManualGatewayController@update')->name('deposit.manual.update');

        Route::get('payment/pending/{id?}', 'Admin\PaymentLogController@pending')->name('payment.pending');
        Route::put('payment/action/{id}', 'Admin\PaymentLogController@action')->name('payment.action');
        Route::get('payment/log/{id?}', 'Admin\PaymentLogController@index')->name('payment.log');
        Route::get('payment/search', 'Admin\PaymentLogController@search')->name('payment.search');

        /* ===== Support Ticket ====*/
        Route::get('tickets/{status?}', 'Admin\TicketController@tickets')->name('ticket');
        Route::get('tickets/view/{id}', 'Admin\TicketController@ticketReply')->name('ticket.view');
        Route::put('ticket/reply/{id}', 'Admin\TicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'Admin\TicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'Admin\TicketController@ticketDelete')->name('ticket.delete');

        /* ===== Subscriber =====*/
        Route::get('subscriber', 'Admin\SubscriberController@index')->name('subscriber.index');
        Route::post('subscriber/remove', 'Admin\SubscriberController@remove')->name('subscriber.remove');
        Route::get('subscriber/send-email', 'Admin\SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/send-email', 'Admin\SubscriberController@sendEmail')->name('subscriber.mail');


        /* ===== website controls =====*/
        Route::any('/basic-controls', 'Admin\BasicController@index')->name('basic-controls');
        Route::post('/basic-controls', 'Admin\BasicController@updateConfigure')->name('basic-controls.update');

        /* ===== File Storage System =====*/
        Route::get('/file-storage', [FileStorageController::class, 'index'])->name('fileStorage');
        Route::any('storage/edit/{id}', [FileStorageController::class, 'edit'])->name('storage.edit');
        Route::post('storage/set-default/{id}', [FileStorageController::class, 'setDefault'])->name('storage.setDefault');

        /*========Plugin Configuration ========*/
        Route::get('/plugin-config', 'Admin\BasicController@pluginConfig')->name('plugin.config');
        Route::match(['get', 'post'], 'tawk-config', 'Admin\BasicController@tawkConfig')->name('tawk.control');
        Route::match(['get', 'post'], 'fb-messenger-config', 'Admin\BasicController@fbMessengerConfig')->name('fb.messenger.control');
        Route::match(['get', 'post'], 'google-recaptcha', 'Admin\BasicController@googleRecaptchaConfig')->name('google.recaptcha.control');
        Route::match(['get', 'post'], 'google-analytics', 'Admin\BasicController@googleAnalyticsConfig')->name('google.analytics.control');

        Route::any('/email-controls', 'Admin\EmailTemplateController@emailControl')->name('email-controls');
        Route::post('/email-controls', 'Admin\EmailTemplateController@emailConfigure')->name('email-controls.update');
        Route::post('/email-controls/action', 'Admin\EmailTemplateController@emailControlAction')->name('email-controls.action');
        Route::post('/email/test','Admin\EmailTemplateController@testEmail')->name('testEmail');

        Route::get('/email-template', 'Admin\EmailTemplateController@show')->name('email-template.show');
        Route::get('/email-template/edit/{id}', 'Admin\EmailTemplateController@edit')->name('email-template.edit');
        Route::post('/email-template/update/{id}', 'Admin\EmailTemplateController@update')->name('email-template.update');

        /*========Sms control ========*/
        Route::match(['get', 'post'], '/sms-controls', 'Admin\SmsTemplateController@smsConfig')->name('sms.config');
        Route::post('/sms-controls/action', 'Admin\SmsTemplateController@smsControlAction')->name('sms-controls.action');
        Route::get('/sms-template', 'Admin\SmsTemplateController@show')->name('sms-template');
        Route::get('/sms-template/edit/{id}', 'Admin\SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('/sms-template/update/{id}', 'Admin\SmsTemplateController@update')->name('sms-template.update');

        Route::get('/notify-config', 'Admin\NotifyController@notifyConfig')->name('notify-config');
        Route::post('/notify-config', 'Admin\NotifyController@notifyConfigUpdate')->name('notify-config.update');
        Route::get('/notify-template', 'Admin\NotifyController@show')->name('notify-template.show');
        Route::get('/notify-template/edit/{id}', 'Admin\NotifyController@edit')->name('notify-template.edit');
        Route::post('/notify-template/update/{id}', 'Admin\NotifyController@update')->name('notify-template.update');


        /* ===== ADMIN Language SETTINGS ===== */
        Route::get('language', 'Admin\LanguageController@index')->name('language.index');
        Route::get('language/create', 'Admin\LanguageController@create')->name('language.create');
        Route::post('language/create', 'Admin\LanguageController@store')->name('language.store');
        Route::get('language/{language}', 'Admin\LanguageController@edit')->name('language.edit');
        Route::put('language/{language}', 'Admin\LanguageController@update')->name('language.update');
        Route::delete('language/{language}', 'Admin\LanguageController@delete')->name('language.delete');
        Route::get('/language/keyword/{id}', 'Admin\LanguageController@keywordEdit')->name('language.keywordEdit');
        Route::put('/language/keyword/{id}', 'Admin\LanguageController@keywordUpdate')->name('language.keywordUpdate');
        Route::post('/language/importJson', 'Admin\LanguageController@importJson')->name('language.importJson');
        Route::post('store-key/{id}', 'Admin\LanguageController@storeKey')->name('language.storeKey');
        Route::put('update-key/{id}', 'Admin\LanguageController@updateKey')->name('language.updateKey');
        Route::delete('delete-key/{id}', 'Admin\LanguageController@deleteKey')->name('language.deleteKey');


        Route::get('/logo-seo', 'Admin\BasicController@logoSeo')->name('logo-seo');
        Route::put('/logoUpdate', 'Admin\BasicController@logoUpdate')->name('logoUpdate');
        Route::put('/seoUpdate', 'Admin\BasicController@seoUpdate')->name('seoUpdate');
        Route::get('/breadcrumb', 'Admin\BasicController@breadcrumb')->name('breadcrumb');
        Route::put('/breadcrumb', 'Admin\BasicController@breadcrumbUpdate')->name('breadcrumbUpdate');


        /* ===== ADMIN TEMPLATE SETTINGS ===== */
        Route::get('template/{section}', 'Admin\TemplateController@show')->name('template.show');
        Route::put('template/{section}/{language}', 'Admin\TemplateController@update')->name('template.update');
        Route::get('contents/{content}', 'Admin\ContentController@index')->name('content.index');
        Route::get('content-create/{content}', 'Admin\ContentController@create')->name('content.create');
        Route::put('content-create/{content}/{language?}', 'Admin\ContentController@store')->name('content.store');
        Route::get('content-show/{content}/{name?}', 'Admin\ContentController@show')->name('content.show');
        Route::put('content-update/{content}/{language?}', 'Admin\ContentController@update')->name('content.update');
        Route::delete('contents/{id}', 'Admin\ContentController@contentDelete')->name('content.delete');

        /* ===== ADMIN Blog Manage ===== */
        Route::get('blog-category', 'Admin\BlogController@categoryList')->name('blogCategory');
        Route::get('blog-category-create', 'Admin\BlogController@blogCategoryCreate')->name('blogCategoryCreate');
        Route::post('blog-category-store/{language?}', 'Admin\BlogController@blogCategoryStore')->name('blogCategoryStore');
        Route::get('blog-category-edit/{id}', 'Admin\BlogController@blogCategoryEdit')->name('blogCategoryEdit');
        Route::put('/blog-category-update/{id}/{language?}', 'Admin\BlogController@blogCategoryUpdate')->name('blogCategoryUpdate');
        Route::delete('/blog-category-delete/{id}', 'Admin\BlogController@blogCategoryDelete')->name('blogCategoryDelete');


        Route::get('blog-list', 'Admin\BlogController@blogList')->name('blogList');
        Route::get('blog-create', 'Admin\BlogController@blogCreate')->name('blogCreate');
        Route::post('blog-store/{language?}', 'Admin\BlogController@blogStore')->name('blogStore');
        Route::get('blog-edit/{id}', 'Admin\BlogController@blogEdit')->name('blogEdit');
        Route::put('blog-update/{id}/{language?}', 'Admin\BlogController@blogUpdate')->name('blogUpdate');
        Route::delete('blog-delete/{id}', 'Admin\BlogController@blogDelete')->name('blogDelete');

        /* ===== ADMIN Listing Manage ===== */
        Route::get('listing-category', 'Admin\ListingController@listingCategoryList')->name('listingCategory');
        Route::get('listing-category-create', 'Admin\ListingController@listingCategoryCreate')->name('listingCategoryCreate');
        Route::post('listing-category-store/{language?}', 'Admin\ListingController@listingCategoryStore')->name('listingCategoryStore');
        Route::get('listing-category-edit/{id}', 'Admin\ListingController@listingCategoryEdit')->name('listingCategoryEdit');
        Route::put('/listing-category-update/{id}/{language?}', 'Admin\ListingController@listingCategoryUpdate')->name('listingCategoryUpdate');
        Route::delete('listing-category-delete/{id}', 'Admin\ListingController@listingCategoryDelete')->name('listingCategoryDelete');
        Route::post('listing-active', 'Admin\ListingController@listingActive')->name('listingActive');
        Route::post('listing-deactive', 'Admin\ListingController@listingDeactive')->name('listingDeactive');

        Route::get('view-listings/{id?}/{type?}', 'Admin\ListingController@viewListings')->name('viewListings');
        Route::get('edit-listing/{id}', 'Admin\ListingController@editListing')->name('editListing');
        Route::post('listing-update/{id}', 'Admin\ListingController@listingUpdate')->name('listingUpdate');
        Route::delete('view-listing-delete/{id}', 'Admin\ListingController@viewListingDelete')->name('viewListingDelete');

        Route::post('/listing-single-approved', 'Admin\ListingController@listingSingleApproved')->name('listingSingleApproved');
        Route::post('/listing-single-rejected', 'Admin\ListingController@listingSingleRejected')->name('listingSingleRejected');
        Route::post('/listing-approved', 'Admin\ListingController@approvedMultiple')->name('listing-multiple-approved');
        Route::post('/listing-rejected', 'Admin\ListingController@rejectedMultiple')->name('listing-multiple-rejected');
        Route::get('listing-settings', 'Admin\ListingController@listingSettings')->name('listingSettings');
        Route::post('listing-approval-store', 'Admin\ListingController@listingApprovalStore')->name('listingApprovalStore');
        Route::get('wish-list', 'Admin\ListingController@wishList')->name('wishList');
        Route::delete('wish-list-delete/{id?}', 'Admin\ListingController@wishListDelete')->name('wishListDelete');
        Route::get('product-enquiry', 'Admin\ListingController@productEnquiry')->name('productEnquiry');
        Route::get('product-enquiry-messages/{id}', 'Admin\ListingController@seeProductEnquiryReply')->name('seeProductEnquiryReply');
        Route::post('product-message-send', 'Admin\ListingController@productMessageSend')->name('productMessageSend');


        Route::get('listing-analytics/{id?}', 'Admin\ListingController@listingAnalytics')->name('listingAnalytics');
        Route::get('listing-reviews/{id?}', 'Admin\ListingController@listingReview')->name('listingReview');
        Route::delete('listing-review-delete/{id}', 'Admin\ListingController@listingReviewDelete')->name('listingReviewDelete');

        Route::get('/show/listing/analytics/{id}', 'Admin\ListingController@showListingAnalytics')->name('showListingAnalytics');
        Route::get('listing-analytics-delete/{id}', 'Admin\ListingController@listingAnalyticsDelete')->name('listingAnalyticsDelete');

        /* ===== ADMIN Package Manage ===== */
        Route::get('package', 'Admin\PackageController@package')->name('package');
        Route::get('create-package', 'Admin\PackageController@packageCreate')->name('packageCreate');
        Route::post('package-store/{language?}', 'Admin\PackageController@packageStore')->name('packageStore');
        Route::delete('package-delete/{id}', 'Admin\PackageController@packageDelete')->name('packageDelete');
        Route::get('package-edit/{id}', 'Admin\PackageController@packageEdit')->name('packageEdit');
        Route::put('package-update/{id}/{language?}', 'Admin\PackageController@packageUpdate')->name('packageUpdate');

        Route::get('purchase-package-list', 'Admin\PackageController@purchasePackageList')->name('purchasePackageList');
        Route::delete('user-package-delete/{id}', 'Admin\PackageController@userPurchasePackageDelete')->name('userPurchasePackageDelete');
        Route::post('/package-approved', 'Admin\PackageController@approvedMultiple')->name('package-multiple-approved');
        Route::post('/package-cancel', 'Admin\PackageController@cancelMultiple')->name('package-multiple-cancel');

        /* ===== Package Expor Import ===== */
        Route::delete('/multiple-package-delete', 'Admin\PackageController@deleteMultiple')->name('selected.package.delete');
        Route::post('/export-package-excel', 'Admin\PackageController@exportPackageExcel')->name('export.packages.excel');
        Route::post('/export-package-csv', 'Admin\PackageController@exportPackageCsv')->name('export.packages.csv');


        /* ===== ADMIN Amenities Manage ===== */
        Route::get('amenities', 'Admin\AmenitiesController@amenities')->name('amenities');
        Route::get('create-amenities', 'Admin\AmenitiesController@amenitiesCreate')->name('amenitiesCreate');
        Route::post('amenities-store/{language?}', 'Admin\AmenitiesController@amenitiesStore')->name('amenitiesStore');
        Route::get('amenities-edit/{id}', 'Admin\AmenitiesController@amenitiesEdit')->name('amenitiesEdit');
        Route::put('/amenities-update/{id}/{language?}', 'Admin\AmenitiesController@amenitiesUpdate')->name('amenitiesUpdate');
        Route::delete('amenities-delete/{id}', 'Admin\AmenitiesController@amenitiesDelete')->name('amenitiesDelete');

        /* ===== ADMIN Place Manage ===== */
        Route::get('place', 'Admin\PlaceController@place')->name('place');
        Route::get('create-place', 'Admin\PlaceController@placeCreate')->name('placeCreate');
        Route::post('place-store', 'Admin\PlaceController@placeStore')->name('placeStore');
        Route::get('place-edit/{id}', 'Admin\PlaceController@placeEdit')->name('placeEdit');
        Route::put('/place-update/{id}', 'Admin\PlaceController@placeUpdate')->name('placeUpdate');
        Route::delete('place-delete/{id}', 'Admin\PlaceController@placeDelete')->name('placeDelete');

        /* ===== Admin Claim Business Manage ===== */
        Route::get('claim-business', 'Admin\ClaimBusinessController@claimBusiness')->name('claimBusiness');
        Route::delete('claim-message-delete/{id?}', 'Admin\ClaimBusinessController@claimMessageDelete')->name('claimMessageDelete');
        /* ===== Admin Contact Message Manage ===== */
        Route::get('/contact-message', 'Admin\ContactMessageController@contactMessage')->name('contactMessage');
        Route::delete('/contact-message-delete/{id}', 'Admin\ContactMessageController@contactMessageDelete')->name('contactMessageDelete');

        Route::get('admin/blog/create', 'Admin\ContentController@blog_list')->name('blog.create');

        Route::get('push-notification-show', 'SiteNotificationController@showByAdmin')->name('push.notification.show');
        Route::get('push.notification.readAll', 'SiteNotificationController@readAllByAdmin')->name('push.notification.readAll');
        Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');
        Route::match(['get', 'post'], 'pusher-config', 'SiteNotificationController@pusherConfig')->name('pusher.config');
    });
});

Route::group(['middleware' => ['Maintenance']], function () {
    Route::match(['get', 'post'], 'success', 'PaymentController@success')->name('success');
    Route::match(['get', 'post'], 'success', 'PaymentController@success')->name('success');
    Route::match(['get', 'post'], 'failed', 'PaymentController@failed')->name('failed');
    Route::match(['get', 'post'], 'payment/{code}/{trx?}/{type?}', 'PaymentController@gatewayIpn')->name('ipn');

    Route::post('/khalti/payment/verify/{trx}', 'khaltiPaymentController@verifyPayment')->name('khalti.verifyPayment');
    Route::post('/khalti/payment/store','khaltiPaymentController@storePayment')->name('khalti.storePayment');

    Route::get('/language/{code?}', 'FrontendController@language')->name('language');


    Route::get('/', 'FrontendController@index')->name('home');
    Route::get('/about', 'FrontendController@about')->name('about');
    Route::get('/pricing', 'FrontendController@pricing')->name('pricing');
    Route::get('/purchasePlan', 'FrontendController@purchasePlan')->name('purchasePlan');

    Route::get('/listing/{id?}/{type?}', 'FrontendController@listingSearch')->name('listing');
    Route::get('/listing-details/{title?}/{id?}', 'FrontendController@listing_details')->name('listing-details');
    Route::get('/listingReviews/{id?}', 'FrontendController@getReview')->name('listingReviews');
    Route::get('/profile/{name?}/{user_id?}', 'FrontendController@profile')->name('profile');

    Route::get('/category', 'FrontendController@category')->name('category');
    Route::get('/blog', 'FrontendController@blog')->name('blog');
    Route::get('/blog-details/{slug}/{id}', 'FrontendController@blogDetails')->name('blogDetails');
    Route::get('category-wise-blog/{slug}/{id}', 'FrontendController@CategoryWiseBlog')->name('CategoryWiseBlog');

    Route::get('blog-search', 'FrontendController@blogSearch')->name('blogSearch');
    Route::post('category-search', 'FrontendController@categorySearch')->name('categorySearch');

    Route::get('/contact', 'FrontendController@contact')->name('contact');
    Route::get('/faq', 'FrontendController@faq')->name('faq');
    Route::post('/contact', 'FrontendController@contactSend')->name('contact.send');
    Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
    Route::get('/{getLink}/{content_id}', 'FrontendController@getLink')->name('getLink');

    Route::get('/{template?}', 'FrontendController@getTemplate')->name('getTemplate');
});


