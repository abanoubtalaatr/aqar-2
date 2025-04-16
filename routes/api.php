<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\WebsiteFavoriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//=======================================================================
//========================Auth Not Required=================================
//=======================================================================
Route::group([
    'prefix' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => ['lang'],
], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication...
    |--------------------------------------------------------------------------
    */

    Route::get('info', [App\Http\Controllers\Api\SettingController::class, 'info']);
    Route::post('login', App\Http\Controllers\Api\Auth\LoginController::class);
    Route::post('login-with-device-id', App\Http\Controllers\Api\Auth\LoginWithDeviceController::class);

    Route::post('register', App\Http\Controllers\Api\Auth\RegisterController::class);
    Route::post('verify-email', [App\Http\Controllers\Api\AuthController::class, 'verifyEmail']);
    Route::post('resend-verification-code', [App\Http\Controllers\Api\AuthController::class, 'resendVerificationEmail']);

    Route::post('forgot-password/send-email', [App\Http\Controllers\Api\PasswordResetController::class, 'sendEmail']);
    Route::post('forgot-password/reset-password', [App\Http\Controllers\Api\PasswordResetController::class, 'resetPassword']);
    Route::post('forgot-password/resend-reset-email', [App\Http\Controllers\Api\PasswordResetController::class, 'resendResetToken']);


    /*
    |--------------------------------------------------------------------------
    | General api...
    |--------------------------------------------------------------------------
    */
    Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('category/keys/{id}', [App\Http\Controllers\Api\CategoryController::class, 'getCategoryKeys']);
    Route::get('category/order-keys/{id}', [App\Http\Controllers\Api\CategoryController::class, 'getCategoryKeysForOrders']);
    Route::get('face-buildings', [App\Http\Controllers\Api\RealEstate\FaceBuildingController::class, 'index']);
    Route::get('purposes-for-housing', [App\Http\Controllers\Api\PurposeController::class, 'index']);
    Route::get('rent-durations', [App\Http\Controllers\Api\RentDurationController::class, 'index']);
    Route::post('/contact', [App\Http\Controllers\Api\SettingController::class, 'contact']);
    Route::get('/partners', [App\Http\Controllers\Api\SettingController::class, 'partners']);
    Route::get('home-categories', [App\Http\Controllers\Api\HomeCategoryController::class, 'index']);
    Route::get('cities', [App\Http\Controllers\Api\CityController::class, 'index']);
    /*
    |--------------------------------------------------------------------------
    | Static pages...
    |--------------------------------------------------------------------------
    */
    // Route::apiResource('pages', App\Http\Controllers\Api\PageController::class)->only('index', 'show');
    Route::get('terms', [App\Http\Controllers\Api\PageController::class, 'terms']); // terms and conditions page

    Route::get('reasons', [App\Http\Controllers\Api\ReasonController::class, 'index']);

    Route::apiResource('all-real-estates', App\Http\Controllers\Api\AdController::class)->only('show', 'index');

    /*
    |--------------------------------------------------------------------------
    |  FAQ...
    |--------------------------------------------------------------------------
     */
    Route::get('faqs', [App\Http\Controllers\Api\FAQController::class, 'index']);
    Route::apiResource('all-orders', App\Http\Controllers\Api\Order\OrderController::class)->only('index', 'show');

    /*
    |--------------------------------------------------------------------------
    |  User details...
    |--------------------------------------------------------------------------
    */
    Route::get('/users/{user}/details', [App\Http\Controllers\Api\UserDetailsController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    |  partners...
    |--------------------------------------------------------------------------
    */
    Route::get('partners', [App\Http\Controllers\Api\PartnerController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    |  Real estate index مؤشر العقار...
    |--------------------------------------------------------------------------
    */
    Route::get('real-estates-index', App\Http\Controllers\Api\RealEstateIndexController::class);

    /*
    |--------------------------------------------------------------------------
    |  Nibras مجله نبراس...
    |--------------------------------------------------------------------------
    */

    Route::get('nibras-cities', [App\Http\Controllers\Api\CityController::class, 'nibras']);
    Route::get('cities/{city?}/articles', [App\Http\Controllers\Api\ArticleController::class, 'index']);
    Route::get('articles/{article}', [App\Http\Controllers\Api\ArticleController::class, 'show']);


    /*
    |--------------------------------------------------------------------------
    |  Setting for commission and pay online
    |--------------------------------------------------------------------------
    */


    Route::get('settings-for-commission-and-pay-online', [App\Http\Controllers\Api\SettingController::class, 'commissionAndPayOnline']);
    Route::get('settings', [App\Http\Controllers\Api\SettingController::class, 'settings']);

    /*
    |--------------------------------------------------------------------------
    |  Search in ads or orders
    |--------------------------------------------------------------------------
    */
    Route::get('search', [SearchController::class,'index']);
});



//=======================================================================
//========================Auth Required=================================
//=======================================================================

Route::group(
    [
        'prefix' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
        'middleware' => ['auth:api', 'lang'],
    ],
    function () {

        /*
        |--------------------------------------------------------------------------
        |  Real states or ads...
        |--------------------------------------------------------------------------
        */
        Route::apiResource('real-estates', App\Http\Controllers\Api\AdController::class)->only('show', 'index');

        Route::post('real-estates/license-number', \App\Http\Controllers\Api\RealEstate\LicenseNumberController::class)->name('real-estates.license-number');
        Route::post('real-estates/{id}/location', App\Http\Controllers\Api\RealEstate\LocationController::class)->name('real-estates.location');
        Route::post('real-estates/update/{id}', [App\Http\Controllers\Api\AdController::class, 'update'])->name('ad.update');
        Route::post('real-estates-rent-by-day-or-month', [App\Http\Controllers\Api\RealEstate\AdvertisementByDayOrMonthController::class, 'store']);
        Route::put('real-estates-rent-by-day-or-month/{ad}', [App\Http\Controllers\Api\RealEstate\AdvertisementByDayOrMonthController::class, 'update']);
        Route::post('files/{file}/remove', [App\Http\Controllers\Api\FileAdvertisementController::class, 'destroy']);
        Route::get('real-estates/{real_estate}/assets', [App\Http\Controllers\Api\RealEstate\ShowAdAssetController::class, 'show']);
        Route::post('real-estates/upload-assets/{id}', [App\Http\Controllers\Api\FileAdvertisementController::class, 'store']);
        Route::delete('real-estates/{real_estate}/delete', [App\Http\Controllers\Api\AdController::class, 'destroy']);
        Route::post('real-estates/{real_estate}/publish', App\Http\Controllers\Api\RealEstate\PublishAdController::class);

        /*
        |--------------------------------------------------------------------------
        |  Profile...
        |--------------------------------------------------------------------------
        */

        Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('profile', [App\Http\Controllers\Api\UserController::class, 'profile']);
        Route::put('profile/update/password', App\Http\Controllers\Api\UpdatePasswordController::class);

        Route::post('update/profile', [App\Http\Controllers\Api\UserController::class, 'updateProfile']);
        Route::delete('delete/account', [App\Http\Controllers\Api\UserController::class, 'deleteAccount']);

        /*
        |--------------------------------------------------------------------------
        |  My Real Estates ads...
        |--------------------------------------------------------------------------
        */

        Route::apiResource('my-real-estates', App\Http\Controllers\Api\RealEstate\MyRealEstateController::class);
        Route::post('real-estates/{real_estate}/change-published-at', App\Http\Controllers\Api\RealEstate\ChangePublishAtAdController::class);
        Route::get('my-real-estates-counts', [App\Http\Controllers\Api\RealEstate\MyRealEstateController::class, 'myRealEstatesCounts']);

        /*
        |--------------------------------------------------------------------------
        |  Orders...
        |--------------------------------------------------------------------------
        */

        Route::apiResource('orders', App\Http\Controllers\Api\Order\OrderController::class)->except('update');
        Route::post('orders/{order}/update', [App\Http\Controllers\Api\Order\OrderController::class, 'update']);
        Route::post('orders/{order}/location', App\Http\Controllers\Api\Order\OrderLocationController::class);
        Route::post('orders/{order}/change-published-at', App\Http\Controllers\Api\Order\ChangePublishAtOrderController::class);
        Route::post('orders/{order}/publish', App\Http\Controllers\Api\Order\PublishOrderController::class);

        /*
        |--------------------------------------------------------------------------
        |  My Orders...
        |--------------------------------------------------------------------------
        */

        Route::apiResource('my-orders', App\Http\Controllers\Api\Order\MyOrderController::class)
            ->only('index', 'show', 'destroy');


        /*
        |--------------------------------------------------------------------------
        |  Chat...
        |--------------------------------------------------------------------------
        */

        Route::get('chats', [App\Http\Controllers\Api\ChatController::class, 'index']);
        Route::post('chats', [App\Http\Controllers\Api\ChatController::class, 'store']);
        Route::get('chats/{chat}', [App\Http\Controllers\Api\ChatController::class, 'getChat']);
        Route::post('first-chat', App\Http\Controllers\Api\FirstChatController::class);

        // --- Block user ---
        Route::post('users/{user}/block', App\Http\Controllers\Api\SingleActions\Chat\BlockUserController::class);
        Route::post('users/{user}/unblock', App\Http\Controllers\Api\SingleActions\Chat\UnBlockUserController::class);

        /*
        |--------------------------------------------------------------------------
        |  Followers and following...
        |--------------------------------------------------------------------------
        */

        Route::post('/users/{user}/follow', [App\Http\Controllers\Api\FollowController::class, 'follow']);
        Route::post('/users/{user}/unfollow', [App\Http\Controllers\Api\FollowController::class, 'unfollow']);
        Route::get('/users/following', [App\Http\Controllers\Api\FollowController::class, 'getFollowings']);
        Route::get('/users/followers', [App\Http\Controllers\Api\FollowController::class, 'getFollowers']);

        /*
        |--------------------------------------------------------------------------
        |  Ratings...
        |--------------------------------------------------------------------------
        */

        Route::get('/users/{user}/rating', [App\Http\Controllers\Api\RatingController::class, 'getUserRating']);
        Route::post('/rate/{rateableType}/{rateableId}', [App\Http\Controllers\Api\RatingController::class, 'store']);
        Route::put('/rate/{rateableType}/{rateableId}', [App\Http\Controllers\Api\RatingController::class, 'update']);
        Route::get('/rate/{rateableType}/{rateableId}', [App\Http\Controllers\Api\RatingController::class, 'showAverage']);
        Route::get('ratings-count/{rateableType}/{rateableId}', [App\Http\Controllers\Api\RatingController::class, 'getRatingsCount']);

        /*
        |--------------------------------------------------------------------------
        |  Reports...
        |--------------------------------------------------------------------------
        */
        Route::post('reports', [App\Http\Controllers\Api\ReportController::class, 'store']);

        /*
        |--------------------------------------------------------------------------
        |  Draft...
        |--------------------------------------------------------------------------
        */

        Route::get('my-ads-drafts', [App\Http\Controllers\Api\RealEstate\DraftAdController::class, 'index']);
        Route::post('ads/{ad}/make-draft', App\Http\Controllers\Api\RealEstate\MakeAdDraftedController::class);
        Route::post('ads/{ads}/make-un-draft', App\Http\Controllers\Api\RealEstate\MakeAdUnDraftController::class);

        Route::get('my-orders-drafts', [App\Http\Controllers\Api\Order\DraftOrderController::class, 'index']);
        Route::post('orders/{order}/make-draft', App\Http\Controllers\Api\Order\MakeOrderDraftedController::class);
        Route::post('orders/{order}/make-un-draft', App\Http\Controllers\Api\Order\MakeOrderUnDraftController::class);

        /*
        |--------------------------------------------------------------------------
        |  Saved items or favorites (ad, order)...
        |--------------------------------------------------------------------------
        */

        Route::post('/favorites', [FavoriteController::class, 'favorite']);
        Route::delete('/favorites/{ad}', [FavoriteController::class, 'unfavorite']);
        Route::get('/favorites/my', [FavoriteController::class, 'myFavorites']);
        Route::get('/favorites/item/{id}', [FavoriteController::class, 'favoritesForItem']);

        Route::get('/favorites/my', [FavoriteController::class, 'myFavorites']);
        Route::get('/favorites/my/ads', [FavoriteController::class, 'myAdFavorites']);
        Route::get('/favorites/my/orders', [FavoriteController::class, 'myOrderFavorites']);


        Route::get('/favorites/my/website', [WebsiteFavoriteController::class, 'myFavorites']);
        Route::get('/favorites/my/ads/website', [WebsiteFavoriteController::class, 'myAdFavorites']);
        Route::get('/favorites/my/orders/website', [WebsiteFavoriteController::class, 'myOrderFavorites']);
        /*
        |--------------------------------------------------------------------------
        |  Notification...
        |--------------------------------------------------------------------------
        */

        Route::get('/notifications', [App\Http\Controllers\Api\NotificationController::class, 'index']);
        Route::get('notification-counts', [App\Http\Controllers\Api\NotificationController::class, 'notificationCounts']);
        Route::get('/notifications/unread', [App\Http\Controllers\Api\NotificationController::class, 'unread']);
        Route::post('/notifications/read/{id}', [App\Http\Controllers\Api\NotificationController::class, 'markAsRead']);
        Route::post('/notifications/read-all', [App\Http\Controllers\Api\NotificationController::class, 'markAllAsRead']);
        Route::delete('/notifications/{id}', [App\Http\Controllers\Api\NotificationController::class, 'destroy']);
        Route::delete('/notifications', [App\Http\Controllers\Api\NotificationController::class, 'deleteAllNotifications']);

        /*
        |--------------------------------------------------------------------------
        |  Licenses...
        |--------------------------------------------------------------------------
        */

        Route::apiResource('licenses', App\Http\Controllers\Api\LicenseController::class);

        /*
        |--------------------------------------------------------------------------
        |  Contacts...
        |--------------------------------------------------------------------------
        */

        Route::get('contact-types', [App\Http\Controllers\Api\ContactTypeController::class, 'index']);
        Route::post('contacts', [App\Http\Controllers\Api\ContactController::class, 'store']);

        /*
        |--------------------------------------------------------------------------
        |  Service type...
        |--------------------------------------------------------------------------
        */
        Route::get('service-types', [App\Http\Controllers\Api\ServiceTypeController::class, 'index']);
        Route::post('contact-service', [App\Http\Controllers\Api\ContactServiceController::class, 'store']);

        /*
        |--------------------------------------------------------------------------
        |  Visit ad or order...
        |--------------------------------------------------------------------------
        */
        Route::post('visit-ad-or-order', App\Http\Controllers\Api\VisitAdOrOrderController::class);
    }
);
