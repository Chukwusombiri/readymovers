<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $appName = config('app.name');

        // Define your base path to title mappings
        $basePathsToTitlesMapping = [
            '/' => "Home - {$appName} Logistics solutions made easy",
            'about-us' => "About Us - {$appName}, History, and Values",
            'our-services' => "Our Services - {$appName} Logistics Services Overview",
            'clients-reviews' => "Client Reviews - {$appName} clients reviews and testimonials",
            'tracking-shipment' => "{$appName} - Track your shipments and modify order",
            'contact' => "Contact Us - Get in touch with {$appName} Ltd",
            'cookie-policy' => "Cookie Policy - {$appName} cookie policy and preferences",
            'checkout-completed' => "Checkout Completed - {$appName} booking completed",
            'create-checkout-session' => "Create Checkout Session - {$appName} create checkout",
            'show-booking-quote-details' => "Show Booking Details - {$appName} show booking details",
            'get-an-instant-quote/delivery/personal-details' => "{$appName} - Submit Personal Details",
            'get-an-instant-quote/delivery-details' => "{$appName} - Submit delivery details",
        ];

        // Get the current base path from the request
        $basePath = $request->path();

        // Set the title based on the matching base path, or use a default
        $title = $basePathsToTitlesMapping[$basePath === "" ? '/' : '/' . $basePath] ?? "{$appName} - Logistics excellence and reliability";
        if ($request->routeIs('quote')) {
            $title = "{$appName} - Get an Instant Quote for Your Move";
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'titleMeta' => $title,
            'general' => [
                'companyName' => $appName,
                'companyAddress' => config('app.company_address'),
                'companyPhone' => config('app.phone'),
                'fromAddress' => config('mail.from.address'),
                'replyToAddress' => config('mail.reply_to.address'),
                'whatsappChatLink' => config('app.socials.whatsapp'),
                'instagramLink' => config('app.socials.instagram'),
                'facebookLink' => config('app.socials.facebook'),
                'xLink' => config('app.socials.xLink'),
                'companyRegNo' => config('app.regNo'),
                'companyPostCode' => config('app.postCode'),
            ]
        ]);
    }
}
