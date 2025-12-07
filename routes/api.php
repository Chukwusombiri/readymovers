<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\PackingAndUnpackingController;
use App\Http\Controllers\QuoteController;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('web')->group(function(){
    Route::controller(QuoteController::class)->group(function(){
        Route::post('/move/delivery-items','validateDeliveryItems')->name('api.validate-items.move');
        Route::post('/move/user-info','validateUserInfo')->name('api.user-info.move');
        Route::get('/move/fetchSummary','fetchSummary')->name('api.fetch-summary.move');
        Route::post('/move/checkout','checkoutOrWhatsApp')->name('api.checkout.move');
    });

    Route::controller(PackingAndUnpackingController::class)->group(function(){
        Route::post('/packing-unpacking/details','validateDetails')->name('api.validate-details.packing_unpacking');
        Route::post('/validate-packing-unpacking-items','validateItems')->name('api.validate-items.packing_unpacking');
        Route::post('/packing-unpacking-validate-user-info','validateUserInfo')->name('api.validate-user-info.packing_unpacking');
        Route::get('/packing-unpacking-fetch-summary','fetchSummary')->name('api.fetch-summary.packing_unpacking');
        Route::get('/packing-unpacking/checkout','checkout')->name('api.checkout.packing_unpacking');
    });

    Route::controller(GuestController::class)->group(function(){
        Route::get('/track-move','trackAndRedirect')->name('api.track-redirect');
    });

    Route::get('/fetchItems', function(){
        $all_items = Item::select('id','name','isCountable')->get();
        $items = [];
        foreach ($all_items as $key => $item) {
           $items[] = [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->isCountable ? 1 : null
           ];
        }

        return response()->json($items);
    });
});

