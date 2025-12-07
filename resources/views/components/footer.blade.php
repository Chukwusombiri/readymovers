<footer class="border-t border-neutral-700/20 py-10 px-6 bg-white dark:bg-gray-900 dark:text-gray-300 overflow-x-hidden">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap items-center justify-between gap-10 md:items-start lg:flex-nowrap">            
            <div class="w-full md:w-2/3">
                <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-3 sm:gap-6 md:grid-cols-4 md:pr-4">
                    <div>
                        <h3 class="font-bold uppercase text-gray-700 dark:text-gray-300">Pages</h3>
                        <ul class="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                            <li><a href="{{route('services')}}">&#10147; Services</a></li>
                            <li><a href="{{route('quote')}}">&#10147; Quote</a></li>
                            <li><a href="{{route('tracker')}}">&#10147; Track</a></li>
                            <li><a href="{{route('about').'#faq'}}">&#10147; FAQ</a></li>
                            {{-- <li><a href="{{route('review')}}">&#10147; Testimonials</a></li> --}}
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase text-gray-700 dark:text-gray-300">Support</h3>
                        <ul class="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                            <li><a href="{{route('about')}}">&#10147; Organization</a></li>
                            <li><a href="mailto:{{config('mail.from.address')}}">&#10147; Request Feedback</a></li>
                            <li><a href="mailto:{{config('mail.from.address')}}">&#10147; Submit Bugs</a></li>
                            <li><a href="{{route('contact')}}">&#10147; Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase text-gray-700 dark:text-gray-300">Legal</h3>
                        <ul class="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                            <li><a href="{{route('policy.show')}}">&#10147; Privacy Policy</a></li>
                            <li><a href="{{route('terms.show')}}">&#10147; Terms of service</a></li>
                            <li><a href="{{route('cookiePolicy')}}">&#10147; Cookie Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase text-gray-700 dark:text-gray-300">Contact</h3>
                        <ul class="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                            <li class="flex items-center gap-2">
                                <a href="mailto:{{config('mail.reply_to.address')}}" class="inline-link flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tabler-icon tabler-icon-mail">
                                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                        <path d="M3 7l9 6l9 -6"></path>
                                    </svg>{{config('mail.reply_to.address')}}
                                </a>
                            </li>
                            <li class="flex w-auto items-center justify-start gap-2">
                                <a href="{{config('app.socials.whatsapp')}}" class="inline-link flex gap-2" target="_blank" rel="noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                    </svg>Whatsapp
                                </a>
                            </li>
                            <li class="flex w-auto items-center justify-start gap-2">
                                <a href="{{config('app.socials.facebook')}}" class="inline-link flex gap-2" target="_blank" rel="noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                    </svg>Facebook
                                </a>
                            </li>
                            <li class="flex w-auto items-center justify-start gap-2">
                                <a href="{{config('app.socials.instagram')}}" class="inline-link flex gap-2" target="_blank" rel="noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M16.5 7.5l0 .01" />
                                    </svg>Instagram
                                </a>
                            </li>
                            <li class="flex w-auto items-center justify-start gap-2">
                                <span>{{config('app.company_address')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-2/3 lg:w-1/3">
                <a href="/" class="block h-16">
                    <x-application-logo class="block h-24 w-auto" />
                </a>
                <p class="mb-4 mt-2 text-gray-700 dark:text-gray-300">
                    With a commitment to reliability, efficiency, and customer satisfaction, we have built a reputation as a leading provider of home moving and transportation services in the UK.                </p>
            </div>
        </div>
        <div class="mt-10 flex justify-center text-sm text-gray-700 dark:text-gray-300">
            <div class="text-center">© {{now()->year}} {{config('app.name')}} All rights reserved.</div>
        </div>
    </div>
</footer>