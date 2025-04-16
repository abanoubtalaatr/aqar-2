<?php

use App\Exports\AdsExport;
use App\Exports\OrdersExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Admin\Ad\AdController;
use App\Http\Controllers\Admin\Ad\AdMonthOrDayController;
use App\Http\Controllers\Admin\Ad\AdRentController;
use App\Http\Controllers\Admin\Ad\AdSellController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityArticleController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactServicesController;
use App\Http\Controllers\Admin\ContactTypesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\FAQTypeController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Order\OrderRentController;
use App\Http\Controllers\Admin\Order\OrderSellController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\Report\ReportAdController;
use App\Http\Controllers\Admin\Report\ReportOrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LangController;
use App\Models\Category;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Admin\ChatifyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('lang/{lang}', [LangController::class, 'change'])->name('changeLang');

//------------ Global --------------
Route::post('ajax/states/load', [AjaxController::class, 'load_states'])->name('load_states');
Route::post('ajax/cities/load', [AjaxController::class, 'load_cities'])->name('load_cities');
Route::post('ajax/categories/load', [AjaxController::class, 'load_categories'])->name('load_categories');


Route::middleware('LanguageManager')->prefix('admin')->as('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        //-------- Login ---------
        Route::controller(AuthController::class)->group(function () {
            Route::get('/admin/login', 'login')->name('login');
            Route::post('login/submit', 'submitLogin')->name('submitLogin');
        });
        //-------- Forget Password ---------
        Route::controller(ForgetPasswordController::class)
            ->group(function () {
                Route::get('forget-password', 'forgetPassword')->name('forgetPassword');
                Route::post('forget-password', 'submitForgetPassword')->name('forgetPassword.submit');
                Route::get('reset-password/{token}', 'resetPassword')->name('resetPassword');
                Route::post('reset-password', 'submitResetPassword')->name('resetPassword.submit');
            });
    });


    Route::middleware(['admin'])->group(function () {

        Route::controller(DashboardController::class)
            ->group(function () {
                Route::get('logout', 'logOut')->name('logOut');

                Route::get('dashboard', 'index')
                    ->name('dashboard');

                Route::get('profile', 'profile')->name('profile');
                Route::post('profile/update', 'updateProfile')->name('profile.update');
                Route::post('profile/change_password/{item}', 'changePassword')->name('profile.change_password');
            });
        //-------- Settings ---------
        Route::prefix('settings')->as('settings.')->controller(SettingController::class)
            ->group(function () {
                Route::get('all', 'index')->name('index');
                Route::put('update', 'update')->name('update');
                Route::post('change_money_password', 'change_money_password')->name('change_money_password');
                Route::post('check_money_password', 'check_money_password')->name('check_money_password');
            });



        Route::resource('notifications', NotificationController::class);

        Route::resource('admins', AdminController::class)->middleware(['can:admin-read,admin-create,admin-delete']);

        Route::resource('roles', RoleController::class)->middleware(['can:role-read,role-create,role-delete']);

        /*
        |--------------------------------------------------------------------------
        |  Random messages...
        |--------------------------------------------------------------------------
        */
        Route::resource('random-messages', \App\Http\Controllers\Admin\RandomMessageController::class)->middleware(['can:random-message-read,random-message-create,random-message-delete']);

        /*
        |--------------------------------------------------------------------------
        |  Users...
        |--------------------------------------------------------------------------
        */
        Route::resource('users', UserController::class)->middleware(['can:user-read,user-create,user-delete']);

        Route::get('admin/users/export', function (Request $request) {
            return Excel::download(new UsersExport($request), 'users.xlsx');
        })->name('users.export');

        Route::get('admin/ads/export', function (Request $request) {
            return Excel::download(new AdsExport($request), 'ads.xlsx');
        })->name('ads.export');


        Route::get('admin/orders/export', function (Request $request) {
            return Excel::download(new OrdersExport($request), 'orders.xlsx');
        })->name('orders.export');
        /*
        |--------------------------------------------------------------------------
        |  Real states or ads...
        |--------------------------------------------------------------------------
        */

        Route::resource('ads', AdController::class)->only('show', 'destroy')->middleware(['can:ad-read,ad-delete']);

        /*
        |--------------------------------------------------------------------------
        |  ads for month or day...
        |--------------------------------------------------------------------------
        */
        Route::resource('ads-month-or-day', AdMonthOrDayController::class)->only('index')->middleware(['can:ad-read']);

        /*
        |--------------------------------------------------------------------------
        |  ads for sell...
        |--------------------------------------------------------------------------
        */
        Route::resource('ads-sell', AdSellController::class)->only('index')->middleware(['can:ad-read']);


        /*
        |--------------------------------------------------------------------------
        |  ads for rent...
        |--------------------------------------------------------------------------
        */
        Route::resource('ads-rent', AdRentController::class)->only('index')->middleware(['can:ad-read']);


        /*
        |--------------------------------------------------------------------------
        |  Orders ...
        |--------------------------------------------------------------------------
        */
        Route::resource('orders', OrderController::class)->only('show', 'destroy')->middleware(['can:order-read,order-delete']);


        /*
        |--------------------------------------------------------------------------
        |  Orders for sell...
        |--------------------------------------------------------------------------
        */
        Route::resource('orders-sell', OrderSellController::class)->only('index')->middleware(['can:order-read,order-delete']);


        /*
        |--------------------------------------------------------------------------
        |  orders for rent...
        |--------------------------------------------------------------------------
        */
        Route::resource('orders-rent', OrderRentController::class)->only('index')->middleware(['can:order-read,order-delete']);

        /*
        |--------------------------------------------------------------------------
        |  Contact us and replies...
        |--------------------------------------------------------------------------
        */

        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index')->middleware(['can:contact-read,order-response']);
        Route::post('/contacts/respond/{id}', [ContactController::class, 'respond'])->name('contacts.respond')->middleware(['can:contact-read,contact-response']);
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy')->middleware(['can:contact-delete']);


        /*
        |--------------------------------------------------------------------------
        |  Notifications...
        |--------------------------------------------------------------------------
        */
        Route::get('admin/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware(['can:notification-read']);
        Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send')->middleware(['can:notification-create']);
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy')->middleware(['can:notification-delete']);

        /*
        |--------------------------------------------------------------------------
        |  cities...
        |--------------------------------------------------------------------------
        */
        Route::resource('cities', CityController::class)->middleware(['can:city-read,city-create,city-delete,city-show']);


        /*
        |--------------------------------------------------------------------------
        |  cities for articles that belongs only nibras (articles that appear in mobile and web this cities is totaley different about the above city because cities only is for landing page in web and mobile application)...
        |--------------------------------------------------------------------------
        */
        Route::resource('cities-articles', CityArticleController::class)->middleware(['can:article-read,article-create,article-delete,article-show']);

        /*
        |--------------------------------------------------------------------------
        |  licenses...
        |--------------------------------------------------------------------------
        */
        Route::resource('licenses', LicenseController::class)->middleware(['can:license-read,license-create,license-delete,license-show']);

        Route::post('licenses/{license}/change-status/{status}', [LicenseController::class, 'changeStatus'])->name('licenses.changeStatus')->middleware(['can:license-update']);

        /*
        |--------------------------------------------------------------------------
        |  articles...
        |--------------------------------------------------------------------------
        */

        Route::resource('articles', ArticleController::class)->middleware(['can:article-read,article-create,article-delete,article-show']);
        Route::post('articles/{article}/change-status', [ArticleController::class, 'changeStatus'])->name('articles.changeStatus')->middleware(['can:article-update']);

        /*
        |--------------------------------------------------------------------------
        |  FAQS...
        |--------------------------------------------------------------------------
        */
        Route::resource('faqs', FAQController::class)->except('show')->middleware(['can:faq-read,faq-create,faq-delete']);

        /*
        |--------------------------------------------------------------------------
        |  FAQS type...
        |--------------------------------------------------------------------------
        */
        Route::resource('faq-types', FAQTypeController::class)->except('show')->middleware(['can:faq-type-read,faq-type-create,faq-type-delete']);


        /*
        |--------------------------------------------------------------------------
        |  service type...
        |--------------------------------------------------------------------------
        */
        Route::resource('service-types', ServiceTypeController::class)->except('show')->middleware(['can:service-type-read,service-type-create,service-type-delete']);


        /*
        |--------------------------------------------------------------------------
        |  contact-services...
        |--------------------------------------------------------------------------
        */

        Route::resource('contact-services', ContactServicesController::class)->middleware(['can:contact-service-read,contact-service-create,contact-service-delete']);
        Route::get('contact-services/{contact_service}/reply', [ContactServicesController::class, 'reply'])->name('contact-services.reply');
        Route::post('contact-services/{contact_service}/reply', [ContactServicesController::class, 'storeReply'])->name('contact-services.store-reply');

        /*
        |--------------------------------------------------------------------------
        |  contact types...
        |--------------------------------------------------------------------------
        */

        Route::resource('contact-types', ContactTypesController::class)->middleware(['can:contact-type-read,contact-type-create,contact-type-delete']);

        /*
        |--------------------------------------------------------------------------
        |  categories...
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class)->middleware(['can:category-read,category-create,category-delete']);

        /*
        |--------------------------------------------------------------------------
        |  statistics...
        |--------------------------------------------------------------------------
        */
        Route::get('statistics', StatisticController::class)->name('statistics.index');
        Route::get('statistics/export', [StatisticController::class, 'export'])->name('statistics.export');


        /*
        |--------------------------------------------------------------------------
        |  service providers ...
        |--------------------------------------------------------------------------
        */
        Route::resource('service-providers', ServiceProviderController::class)->middleware(['can:service-provider-read,service-provider-create,service-provider-delete']);

        /*
        |--------------------------------------------------------------------------
        |  report ads...
        |--------------------------------------------------------------------------
        */
        Route::resource('report-ads', ReportAdController::class)->middleware(['can:report-ad-read,report-ad-create,report-ad-delete']);


        /*
        |--------------------------------------------------------------------------
        |  report orders...
        |--------------------------------------------------------------------------
        */
        Route::resource('report-orders', ReportOrderController::class)->middleware(['can:report-order-read,report-order-create,report-order-delete']);


        /*
        |--------------------------------------------------------------------------
        |  partners...
        |--------------------------------------------------------------------------
        */
        Route::resource('partners', PartnerController::class)->middleware(['can:partner-read,partner-create,partner-delete']);

        Route::prefix('page')->as('page.')->controller(PageController::class)
            ->group(function () {
                Route::get('{slug}', 'item')->name('index');
                Route::put('update/{item}', 'update')->name('update');
            })->middleware(['can:page-read,page-create,page-delete']);



        Route::post('/status_change/{model}/{item}', [DashboardController::class, 'status_change'])->name('status_change');
    });

    Route::fallback(function () {
        return redirect()->intended();
    });

});

Route::get('/admin/ads/get-filters', function (Request $request) {
    $categoryId = $request->input('category_id');
    $category = Category::find($categoryId);

    if ($category && view()->exists('admin.ads.filters.' . strtolower($category->name))) {
        return view('admin.ads.filters.' . strtolower($category->name_en));
    }

    return response()->json(['error' => 'Filters not found'], 404);
})->name('admin.ads.getFilters');

Route::get('/', function () {
    return redirect('/admin/admin/login');
});


Route::prefix('chatify')->group(function() {
    // Override the default Chatify routes
    Route::get('/getContacts', [ChatifyController::class, 'getContacts'])->name('chatify.contacts');
    Route::get('/search', [ChatifyController::class, 'search'])->name('chatify.search');
    // Include other Chatify routes as needed
});
