<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 z-50">
    <x-banner />
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('guest_home') }}">
                        <x-application-mark class="block h-24 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-10 lg:flex">
                    <x-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')">
                        {{ __('Our services') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                        {{ __('About us') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('tracker') }}" :active="request()->routeIs('tracker')">
                        {{ __('Track shipment') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('quote') }}" :active="request()->routeIs('quote')">
                        {{ __('Get a quote') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                        {{ __('Contact us') }}
                    </x-nav-link>                    
                </div>
            </div>

            <div class="hidden lg:flex flex-wrap sm:items-center sm:ml-6">                
                <!-- Settings Dropdown -->
                <a href="mailto:{{config('mail.reply_to.address')}}" class="flex items-center mr-2 hover:underline text-coral">
                   <span class="mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                        <path d="M3 7l9 6l9 -6" />
                      </svg>
                  </span>
                   <span>{{config('mail.reply_to.address')}}</span>
                </a>
                <a href="tel:{{config('app.phone')}}" class="flex items-center hover:underline text-coral">
                    <span class="mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg>
                   </span>
                    <span>{{config('app.phone')}}</span>                 
                </a>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-coral hover:text-orange-800 focus:outline-none focus:text-orange-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')">
                &#10147; {{ __('Our services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('about') }}" :active="request()->routeIs('dashboard')">
                &#10147; {{ __('About us') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tracker') }}" :active="request()->routeIs('dashboard')">
                &#10147; {{ __('Track shipment') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('quote') }}" :active="request()->routeIs('dashboard')">
                &#10147; {{ __('Get a quote') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('dashboard')">
                &#10147; {{ __('Contact us') }}
            </x-responsive-nav-link>            
        </div>  
        <div class="pl-3 pt-2 pb-3">
            <div class="flex items-center mb-4">
                <span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                  </svg>
               </span>
                <span class="text-coral">{{config('mail.reply_to.address')}}</span>
             </div>
             <div class="flex items-center">
                 <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                      </svg>          
                </span>
                 <span class="text-coral">{{config('app.phone')}}</span>
            </div>   
        </div>      
    </div>
</nav>
