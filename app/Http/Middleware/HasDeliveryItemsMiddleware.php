<?php

namespace App\Http\Middleware;

use App\Models\Item;
use Closure;
use Illuminate\Http\Request;
use App\Traits\HostBasedRedirect;

class HasDeliveryItemsMiddleware
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
        $data = session()->get('delivery_items_details');                   
        if($data==null){
             $this->redirectBasedOnHost('Fill out the required fields');  
             exit;      
        }

        // Query the database to check if any items match the IDs in $inputItems
        $matchingItems = Item::whereIn('id', array_keys($data))->get();

        // Check if the count of matching items is equal to the count of $inputItems
        if ($matchingItems->count() !== count($data)) {
            $this->redirectBasedOnHost('select valid Items! And try to submit form again'); 
        } 
        
        return $next($request);
    }
}
