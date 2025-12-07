<?php

namespace App\Http\Middleware;

use App\Models\Item;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\HostBasedRedirect;
class HasDeliveryItemsAndDetailsAndPersonalMiddleware
{
    use HostBasedRedirect;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $deliverydetails = session()->get('delivery_details');
        $deliveryitemsdetails = session()->get('delivery_items_details');
        $personalDetails = session()->get('personalDetails');
        if(!$deliveryitemsdetails){
            $this->redirectBasedOnHost('Fill out the required fields');
            exit;
        }
        if(!$deliverydetails){
            return redirect()->route('deliveryDetails')->with('error','Fill out the required fields');
            exit;
        }  
        
        if(!$personalDetails){
            return redirect()->back('personalDetails')->with('error','Fill out the required fields');
            exit;
        }  

        // Query the database to check if any items match the IDs in $inputItems
        $matchingItems = Item::whereIn('id', array_keys($deliveryitemsdetails))->get();

        // Check if the count of matching items is equal to the count of $inputItems
        if ($matchingItems->count() !== count($deliveryitemsdetails)) {
            $this->redirectBasedOnHost('Select your transportation items!');
        }

        /* VALIDATE DELIVERY LOCATION DETAILS */
        $validator = Validator::make($deliverydetails, [
            'pickUpAddress' => ['required','string'],
            'pickUpCoordinates' => ['required','array'],
            'pickUpFloor' => ['required','string','exists:floors,name'],
            'pickUpPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
            'pickUpCanUseElevator'=>['boolean'],
            'pickUpNeedExtraMan'=>['boolean'],
            'dropOffAddress' => ['required','string'],
            'dropOffCoordinates' => ['required','array'],
            'dropOffFloor' => ['required','string','exists:floors,name'],
            'dropOffPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
            'pickUpDateTime'=>['required','date','after_or_equal:today'],
            'dropOffNeedExtraMan'=>['boolean'],
            'dropOffCanUseElevator'=>['boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('deliveryDetails')->withErrors($validator);
        }

        /* VALIDATE PERSONAL DETAILS */
        $personalValidator = Validator::make([
            'username' => $personalDetails["username"],
            'email' => $personalDetails["email"],
            'phone' => $personalDetails["phone"],
        ],
        [
            'username' => 'required|string|max:225',
            'email' =>'required|email:dns,rfc',
            'phone'=>['required','regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
        ]);
            
        if ($personalValidator->fails()) {
            return redirect()->back()->withErrors($personalValidator);
        }
        
        return $next($request);
    }
}
