<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        // Register Laravel's base cookies under the "required" cookies section:
        Cookies::essentials()
            ->session()
            ->csrf();

        // Register all Analytics cookies at once using one single shorthand method:                                        
        
        // Register custom cookies under the pre-existing "optional" category:
        Cookies::optional()
            ->name('darkmode_enabled')
            ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
            ->duration(120);
    }
}
