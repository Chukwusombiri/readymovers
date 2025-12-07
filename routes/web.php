<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ClearanceAndWasteController;
use App\Http\Controllers\PackingAndUnpackingController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\In;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(
        function () {
            Route::get('/login', 'login')->middleware(['guest:admin'])->name('admin.login');

            $limiter = config('fortify.limiters.login');
            $twoFactorLimiter = config('fortify.limiters.two-factor');
            $verificationLimiter = config('fortify.limiters.verification', '6,1');

            Route::post('/authenticate', 'authenticate')
                ->middleware(array_filter([
                    'guest:admin',
                    $limiter ? 'throttle:' . $limiter : null,
                ]))->name('admin.login.store');

            Route::post('/admin-logout', 'logout')->name('admin_logout');
            Route::get('/admin-forgot-password', 'forgotPassword')->name('password.forgot');
            Route::post('/admin-forgot-password', 'sendResetPassword')->name('password.send.email');
            Route::get('/admin-reset-password/{token}', 'resetPassword')->name('password.reset');
            Route::post('/admin-reset-password', 'resetComplete')->name('password.reset.complete');
        }
    );
    Route::redirect('/', '/admin/dashboard');
    Route::controller(AdminController::class)->middleware(['auth.admin', 'auth.session.admin',])->group(function () {
        Route::get('/dashboard', 'index')->name('admin_home');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/orders/edit/{id}', 'editOrder')->name('order.edit');
        Route::get('/categories', 'categories')->name('categories');
        Route::get('/categories/new', 'createCategory')->name('categories.create');
        Route::get('/categories/edit/{id}', 'editCategory')->name('categories.edit');
        Route::get('/inquiries', 'inquiries')->name('inquiries');
        Route::get('/inquiries/response/{email}', 'inquiryReply')->name('inquiries.reply');
        Route::get('/subscribers', 'subscribers')->name('subscribers');
        Route::get('/subscribers/edit/{id}', 'editSubscriber')->name('subscriber.edit');
        Route::get('/send-email/{email?}', 'sendEmail')->name('subscriber.email');
        Route::get('/administrators', 'administrators')->name('administrators');
        Route::get('/administrators/new', 'newAdministrator')->name('administrator.new');
        Route::get('/administrators/view/{id}', 'editAdministrator')->name('administrator.edit');
        Route::get('/account/profile', 'profile')->name('admin_profile');
        Route::get('/account/security', 'passwordChange')->name('admin.password.change');
    });
});


// Guest Routes configuration
$guestRoutes = function () {
    Route::get('/', 'index')->name('guest_home');
    Route::get('/quote', 'quote')->name('quote');
    Route::get('/about-us' . config('app.name'), 'about')->name('about');
    Route::get('/tracking-shipment', 'tracker')->name('tracker');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-submit', 'submitContactForm')->name('contact.submit');
};

// Guest Routes
Route::controller(GuestController::class)->group($guestRoutes);
Route::controller(QuoteController::class)->group(function () {
    Route::get('/quote/move', 'moveQuote')->name('quote.move');
    Route::post('/quote/move', 'validateDeliveryDetails')->name('delivery_details.validate');
    Route::get('/checkout-completed', 'completeCheckout')->name('checkout.success');
    Route::post('/checkout-webhook', 'checkoutWebhook')->name('checkout.webhook');
});
Route::get('/quote/packing-and-unpacking', [PackingAndUnpackingController::class, 'index'])->name('quote.packing_unpacking');
Route::get('/quote/clearance-and-waste', [ClearanceAndWasteController::class, 'index'])->name('quote.clearance');
Route::get('/{any}', function () {
    return Inertia\Inertia::render('General/NotFound');
})->where('any', '.*');


/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
