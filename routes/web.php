<?php

use App\Models\User;
use App\Helpers\MainHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SliderController;
use App\Notifications\GeneralNotification;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\MenuLinkController;
use App\Http\Controllers\TrafficsController;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\RedirectionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContactReplyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\FrontStoreController;
use App\Http\Controllers\Frontend\FrontCategoryController;
use App\Http\Controllers\Frontend\FrontAnnouncementController;
use App\Http\Controllers\Frontend\NotificationsController as UserNotification;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\Frontend\FrontDirectoryController;
use App\Http\Controllers\Frontend\FrontHelpCenterController;
use App\Http\Controllers\Frontend\FrontRepresentativeController;
use App\Http\Controllers\Frontend\FrontTransactionController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportErrorController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::post('api/save-token', [FCMController::class, 'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'name'=> 'front.',
    ],
    function () {
        Route::get('/', [FrontController::class, 'index'])->name('home');
        Auth::routes(['register' => false]);
        Route::get('/register/{country?}/{phone?}', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register/', [RegisterController::class, 'register'])->name('register');
        Route::view('about', 'front.pages.about')->name('about');
        Route::view('privacy_policy', 'front.pages.privacy')->name('privacy_policy');

        Route::view('welcome', 'welcome')->name('welcome');
        Route::view('contact', 'front.pages.contact')->name('contact');
        Route::post('contact', [FrontController::class,'contact_post'])->name('contact-post');
        Route::get('blocked', [HelperController::class,'blocked_user'])->name('blocked');
        Route::post('checkPhone', [AuthController::class,'checkPhone'])->name("checkPhone");

        // Help Center
        Route::get("help-center",[FrontHelpCenterController::class,'index'])->name('help');

        Route::name('front.')->group(function () {
            Route::get('users/show/{user}', [FrontStoreController::class,'user_show'])->name('users.show');

            Route::prefix('categories')->group(function () {
                Route::get('', [FrontCategoryController::class,'index'])->name('categories.index');
                Route::get('category/{category}', [FrontCategoryController::class,'show'])->name('categories.show');
            });

            Route::prefix('transactions')->group(function () {
                Route::get('', [FrontTransactionController::class,'index'])->name('transactions.index');
                Route::post('/load-more', [FrontTransactionController::class,'getMoreTransactions'])->name('transactions.load.more');
            });

            Route::prefix('representatives')->group(function () {
                Route::get('', [FrontRepresentativeController::class, 'index'])->name('representatives.index');
                Route::post('/load-more', [FrontRepresentativeController::class, 'getMoreRepresentatives'])->name('representatives.load.more');
            });

            Route::prefix('stores')->group(function () {
                Route::get('', [FrontStoreController::class,'index'])->name('stores.index');
                Route::get('show/{store}', [FrontStoreController::class,'show'])->name('stores.show');
                Route::resource('announcements', FrontAnnouncementController::class)->only('index', 'show');
            });
            Route::prefix('directory')->group(function () {
                Route::get('/stores',[FrontDirectoryController::class,'companiesIndex'])->name("directory.companies");
                Route::get('/individuals',[FrontDirectoryController::class,'individualsIndex'])->name("directory.individuals");
                Route::get('stores/create',[FrontDirectoryController::class,'companiesCreate'])->name("store.create");
                Route::get('individuals/create',[FrontDirectoryController::class,'individualsCreate'])->name("individual.create");
                Route::get('edit/{id}',[FrontDirectoryController::class,'edit'])->name("directory.edit");
                Route::get('show/{id}',[FrontDirectoryController::class,'show'])->name("directory.show");
            });
            // Route::get('announcements/{announcement}', [FrontController::class,'announcement'])->name('announcement.show');

            Route::middleware(['auth'])->group(function () {
                Route::prefix('notifications')->name('notifications.')->group(function () {
                    Route::get('/', [UserNotification::class,'index'])->name('index');
                    Route::get('/ajax', [UserNotification::class,'notifications_ajax'])->name('ajax');
                    Route::post('/see', [UserNotification::class,'notifications_see'])->name('see');
                });

                Route::controller(HomeController::class)->group(function () {
                    Route::get('/chats', 'index')->name('chat');
                    Route::post('/chats', 'createChat')->name('home.createChat');
                    Route::get('/profile', 'profile')->name('profile');
                    Route::get('/profile-edit', 'profile_edit')->name('profile.edit');
                    Route::post('/profile-update', 'profile_update')->name('profile.update');
                });

                // Announcement Vip message view
                Route::get('announcement-created/{announcement}', function ($announcement) {
                    $announcement = App\Models\Announcement::where('number', $announcement)->first();
                    if (!$announcement || $announcement->blocked == 1) {
                        return abort(404);
                    }
                    return view('front.stores.announcement_vip', compact('announcement'));
                })->name('store.announcement_vip');


                Route::controller(FrontStoreController::class)->group(function () {
                    Route::get('my-store', 'my_store')->name('store.my_store');
                    Route::post('my-store', 'my_store_save')->name('store.my_store_save');
                    Route::get('editStore', 'my_store_edit')->name('store.edit');
                    Route::post('editStore', 'my_store_update')->name('store.my_store_update');
                });

                Route::resource('announcements', FrontAnnouncementController::class)->except('index', 'show');
                Route::get('createStoreAnnouncement', [FrontAnnouncementController::class, 'createStoreAnnouncement'])->name('createStoreAnnouncement');

                // Route::get('my-store', [FrontStoreController::class, 'my_store'])->name('store.my_store');

                Route::prefix('upload')->name('upload.')->group(function () {
                    Route::post('/image', [HelperController::class,'upload_image'])->name('image');
                    Route::post('/file', [HelperController::class,'upload_file'])->name('file');
                    Route::post('/remove-file', [HelperController::class,'remove_file'])->name('remove-file');
                });
            });
        });
    }
);

Route::prefix('admin')->middleware(['auth','ActiveAccount', 'IsAdmin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('index');

    Route::middleware(['CheckRole:ADMIN'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::any('admin/transactions/display/{user_id?}', [TransactionController::class, 'showUserTransactions'])->name("user.transactions");
        Route::resource("transactions", TransactionController::class);
        Route::resource("representatives", RepresentativeController::class);
        Route::resource("help-center",HelpCenterController::class);
        Route::resource("directory",DirectoryController::class);
        Route::resource("voucher",VoucherController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('currencies', CurrencyController::class);
        Route::resource('cities', CityController::class);
        Route::resource('states', StateController::class);
        Route::resource('stores', StoreController::class);
        Route::resource('files', FileController::class);
        Route::post('contacts/resolve', [ContactController::class,'resolve'])->can('resolve', \App\Models\Contact::class)->name('contacts.resolve');
        Route::resource('articles', ArticleController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('users', UserController::class);
        Route::resource('packages', PackageController::class);
        Route::resource('subscriptions', SubscriptionController::class);
        Route::resource('pages', PageController::class);
        Route::resource('tables', TableController::class);
        Route::resource('contact-replies', ContactReplyController::class);
        Route::post('faqs/order', [FaqController::class,'order'])->name('faqs.order');
        Route::resource('faqs', FaqController::class);
        Route::post('menu-links/get-type', [MenuLinkController::class,'getType'])->name('menu-links.get-type');
        Route::post('menu-links/order', [MenuLinkController::class,'order'])->name('menu-links.order');
        Route::resource('menu-links', MenuLinkController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('redirections', RedirectionController::class);
        Route::get('traffics', [TrafficsController::class,'index'])->name('traffics.index');
        Route::get('traffics/{traffic}/logs', [TrafficsController::class,'logs'])->name('traffics.logs');
        Route::get('error-reports', [ReportErrorController::class,'index'])->name('traffics.error-reports');
        Route::get('error-reports/{report}', [ReportErrorController::class,'show'])->name('traffics.error-report');
        Route::get('settings/', [SettingController::class,'index'])->name('settings.index');
        Route::put('settings/{settings}/update', [SettingController::class,'update'])->name('settings.update');
    });

    Route::prefix('upload')->name('upload.')->group(function () {
        Route::post('/image', [HelperController::class,'upload_image'])->name('image');
        Route::post('/file', [HelperController::class,'upload_file'])->name('file');
        Route::post('/remove-file', [HelperController::class,'remove_file'])->name('remove-file');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class,'index'])->name('index');
        Route::get('/edit', [ProfileController::class,'edit'])->name('edit');
        Route::put('/update', [ProfileController::class,'update'])->name('update');
        Route::put('/update-password', [ProfileController::class,'update_password'])->name('update-password');
        Route::put('/update-email', [ProfileController::class,'update_email'])->name('update-email');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationsController::class,'index'])->name('index');
        Route::get('/ajax', [NotificationsController::class,'notifications_ajax'])->name('ajax');
        Route::post('/see', [NotificationsController::class,'notifications_see'])->name('see');
    });


});

Route::get('robots.txt', [HelperController::class,'robots']);
Route::get('manifest.json', [HelperController::class,'manifest'])->name('manifest');
Route::get('sitemap.xml', [SiteMapController::class,'sitemap']);
Route::get('sitemaps/links', [SiteMapController::class, 'custom_links']);
Route::get('sitemaps/{name}/{page}/sitemap.xml', [SiteMapController::class,'viewer']);

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

Route::get('get/cities/', [CountryController::class, 'getCitiesByCountry'])->name('get.cities');

Route::get('/pay', function () { return view('payments.paypal'); });
Route::post('/checkout/payment', [PaymentController::class, 'checkout_now'])->name('checkout.payment');
Route::get('/checkout/{order_id}/cancelled', [PaymentController::class, 'cancelled'])->name('checkout.cancel');
Route::get('/checkout/{order_id}/completed', [PaymentController::class, 'completed'])->name('checkout.complete');
Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');