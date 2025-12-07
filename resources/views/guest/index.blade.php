<x-app-layout>
    {{-- hero --}}
    <section class="relative bg-cover bg-center bg-no-repeat dark:bg-gray-800"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url('/images/landing/hero1.jpg') no-repeat center;background-size:cover">
        <div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
            <div class="max-w-xl text-center sm:text-left dark:text-white">
                <h1 class="text-4xl capitolium md:text-5xl lg:text-6xl text-gray-100 tracking-wider">
                    Let's Simplify Your <span class="block text-sky-400">Next Move</span>
                </h1>

                <p class="mt-4 max-w-lg sm:text-xl/relaxed text-gray-100 font-semibold">
                    Driving Excellence, Delivering Success: Your Trusted Partner in Logistics Solutions
                </p>

                <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-4">                    
                    <x-secondary-link href="{{ route('tracker') }}" class="order-2 lg:order-1">
                        <span class="text-coral">Track bookings</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M15 16l4 -4" />
                            <path d="M15 8l4 4" />
                        </svg>
                    </x-secondary-link>
                    <x-link href="{{ route('quote') }}" class="order-1 lg:order-2">
                        Get an instant quote
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M15 16l4 -4" />
                            <path d="M15 8l4 4" />
                        </svg>
                    </x-link>
                </div>
            </div>
        </div>
    </section>
    {{-- how to --}}
    <section class="bg-gray-50 dark:bg-gray-800 py-12 sm:py-16 lg:py-20 xl:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-md lg:max-w-5xl">
                <h2 class="hedvig-regular max-w-2xl text-3xl font-bold tracking-wide text-coral sm:text-4xl lg:text-5xl">Start moving your
                    logistics needs today</h2>
                <p
                    class="mt-4 max-w-2xl text-lg font-normal text-gray-700 dark:text-gray-300 lg:text-xl lg:leading-8">
                    Create your logistics order with these easy steps:</p>
            </div>
            <ul class="mt-12 mx-auto max-w-md grid grid-cols-1 gap-10 sm:mt-16 lg:mt-20 lg:max-w-5xl lg:grid-cols-4">
                <li class="flex-start group relative flex lg:flex-col">
                    <span
                        class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 dark:bg-gray-500 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                        aria-hidiven="true"></span>
                    <div
                        class="inline-flex p-2 h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 dark:bg-gray-900 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <path d="M9 7l1 0" />
                            <path d="M9 13l6 0" />
                            <path d="M13 17l2 0" />
                        </svg>
                    </div>
                    <a href="{{ route('quote') }}" class="block ml-6 lg:ml-0 lg:mt-10">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                            Get instant quote</h3>
                        <h4 class="mt-2 text-base text-gray-700 dark:text-gray-300">Create your logistics order instantly</h4>
                    </a>
                </li>
                <li class="flex-start group relative flex lg:flex-col">
                    <span
                        class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 dark:bg-gray-500 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                        aria-hidiven="true"></span>
                    <div
                        class="inline-flex p-2 h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 dark:bg-gray-900 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" />
                            <path d="M12 2l0 2" />
                            <path d="M12 20l0 2" />
                            <path d="M20 12l2 0" />
                            <path d="M2 12l2 0" />
                          </svg>
                    </div>
                    <a href="{{ route('tracker') }}" class="block ml-6 lg:ml-0 lg:mt-10">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                            Track your logistics</h3>
                        <h4 class="mt-2 text-base text-gray-700 dark:text-gray-300">Find out about your logistics order
                            progress.</h4>
                    </a>
                </li>
                <li class="flex-start group relative flex lg:flex-col">
                    <span
                        class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 dark:bg-gray-500 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                        aria-hidiven="true"></span>
                    <div
                        class="inline-flex p-2 h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 dark:bg-gray-900 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" />
                            <path d="M16 5l3 3" />
                            <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6" />
                        </svg>
                    </div>
                    <a href="{{ route('tracker') }}" class="block ml-6 lg:ml-0 lg:mt-10">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                            Confirm your details</h3>
                        <h4 class="mt-2 text-base text-gray-700 dark:text-gray-300">Modify and make adjustments to your
                            order's delivery details</h4>
                    </a>
                </li>
                <li class="flex-start group relative flex lg:flex-col">
                    <div
                        class="inline-flex p-2 h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 dark:bg-gray-900 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d74315" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                            <path d="M9 7l6 0" />
                            <path d="M9 11l6 0" />
                            <path d="M9 15l4 0" />
                        </svg>
                    </div>
                    <a href="#" class="block ml-6 lg:ml-0 lg:mt-10">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                            Review our service</h3>
                        <h4 class="mt-2 text-base text-gray-700 dark:text-gray-300">Leave a review after order
                            fulfillment if you wish.</h4>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    {{-- services --}}
    <div class="bg-white dark:bg-gray-800 min-h-screen py-16 sm:py-8 lg:py-32">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-8 flex items-end flex-wrap justify-between gap-8 sm:mb-8 md:mb-12">
                <div class="flex flex-col gap-12">
                    <h2 class="hedvig-regular tracking-wide text-4xl font-bold text-coral lg:text-5xl">Our services</h2>

                    <p class="max-w-screen-sm text-gray-500 dark:text-gray-300 md:block">
                        At {{ config('app.name') }}, we don't just deliver services – we deliver results. From
                        transportation and warehousing to supply chain management, we provide comprehensive logistics
                        solutions.
                    </p>
                </div>

                <a href="{{ route('services') }}" class="text-coral font-semibold uppercase flex gap-2 flex-nowrap items-center hover:text-opacity-80">
                    <span>Explore</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l14 0" />
                        <path d="M15 16l4 -4" />
                        <path d="M15 8l4 4" />
                      </svg>
                </a>
            </div>
            <div class="services-slider owl-carousel owl-theme">
                <img src="{{ url('/images/landing/service1.jpg') }}" alt="service 1" class="h-64 w-auto">
                <img src="{{ url('/images/landing/service2.jpg') }}" alt="service 2" class="h-64 w-auto">
                <img src="{{ url('/images/landing/service3.jpg') }}" alt="service 3" class="h-64 w-auto">
                <img src="{{ url('/images/landing/service4.jpg') }}" alt="service 4" class="h-64 w-auto">
                <img src="{{ url('/images/landing/service5.jpg') }}" alt="service 5" class="h-64 w-auto">
            </div>
        </div>
    </div>
    {{-- features --}}
    <section class="overflow-hidden bg-slate-50 py-12 dark:bg-transparent md:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div
                class="mx-auto grid grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        <h2 class="montserrat-semilight text-base leading-7 text-gray-700 dark:text-gray-300">The best logistics solutions</h2>
                        <p class="hedvig-regular tracking-wide mt-2 text-3xl font-bold tracking-tight text-coral md:text-4xl lg:text-5xl">Let's handle your
                            transportation</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">We're the missing piece in your production
                            workflow and supply chain.</p>
                        <div class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 dark:text-gray-400 lg:max-w-none">
                            <div class="flex flex-nowrap gap-4">
                                <div class="w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location mr-3 w-10 h-10" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3730a3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" />
                                        <path d="M12 2l0 2" />
                                        <path d="M12 20l0 2" />
                                        <path d="M20 12l2 0" />
                                        <path d="M2 12l2 0" />
                                    </svg>                                    
                                </div>
                                <div class="grow"><span class="font-semibold text-gray-900 dark:text-gray-200">Real-time Tracking</span> ability to track your deliveries in real-time, ensuring
                                    transparency and peace of mind.
                                </div>
                            </div>
                            <div class="flex flex-nowrap gap-4">
                                <div class="w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus w-10 h-10" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3730a3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                    </svg>                               
                                </div>
                                <div class="grow"><span class="font-semibold text-gray-900 dark:text-gray-200">Delivery Scheduling</span> schedule deliveries at your convenience, including specific time
                                    slots or delivery windows.
                                </div>
                            </div>
                            <div class="flex flex-nowrap gap-4">
                                <div class="w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details w-10 h-10" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3730a3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M13 5h8" />
                                        <path d="M13 9h5" />
                                        <path d="M13 15h8" />
                                        <path d="M13 19h5" />
                                        <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    </svg>                              
                                </div>
                                <div class="grow"><span class="font-semibold text-gray-900 dark:text-gray-200">Multiple Delivery Options</span> variety of delivery options such as express delivery, same-day
                                    delivery, next-day delivery, and standard delivery to cater to different needs.
                                </div>
                            </div>
                            <div class="flex flex-nowrap gap-4">
                                <div class="w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-headset w-10 h-10" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3730a3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 14v-3a8 8 0 1 1 16 0v3" />
                                        <path d="M18 19c0 1.657 -2.686 3 -6 3" />
                                        <path d="M4 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                                        <path d="M15 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                                    </svg>                             
                                </div>
                                <div class="grow"><span class="font-semibold text-gray-900 dark:text-gray-200">Customer Support</span> channels including live chat, email, and phone
                                    support to assist customers with any queries or issues they may have.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex flex-col">
                        <a href="{{ route('quote') }}"
                            class="w-max-content flex items-center gap-2 text-xs uppercase font-semibold leading-6 text-[#3730a3] hover:underline dark:text-indigo-500 dark:hover:text-[#3730a3]">Get Instant quote
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l14 0" />
                                <path d="M15 16l4 -4" />
                                <path d="M15 8l4 4" />
                              </svg>
                        </a>
                        <a href="{{ route('tracker') }}"
                            class="w-max-content flex items-center gap-2 text-xs uppercase font-semibold leading-6 text-[#3730a3] hover:underline dark:text-indigo-500 dark:hover:text-[#3730a3]">Schedule pick-up
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l14 0" />
                                <path d="M15 16l4 -4" />
                                <path d="M15 8l4 4" />
                              </svg>
                        </a>
                    </div>
                </div><img src="{{ url('/images/landing/features.jpg') }}" alt="Product screenshot"
                    class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0"
                    widivh="2432" height="1442">
            </div>
        </div>
    </section>
    {{-- about --}}
    <section
        class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6 dark:text-white">
        <div class="col-span-2 mb-8">
            <p class="text-base montserrat-semilight text-gray-800 dark:text-gray-300">Trusted all over UK</p>
            <h2 class="hedvig-regular tracking-wide mt-3 mb-4 text-3xl font-extrabold tracking-tight text-coral md:text-4xl lg:text-5xl">Trusted by over 6000
                users and 950 teams</h2>
            <p class="text-gray-500 dark:text-gray-300 sm:text-xl">With a commitment to reliability, efficiency, and customer
                satisfaction, we've built a reputation as a leading logistics provider in the UK.</p>
            <div class="pt-6 mt-6 space-y-4 border-t border-gray-200 dark:border-gray-700">
                <div>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center text-base font-medium text-indigo-800 hover:text-indigo-800 dark:text-indigo-500 dark:hover:text-indigo-700">Learn
                        more
                        <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('quote') }}"
                        class="inline-flex items-center text-base font-medium text-indigo-800 hover:text-indigo-800 dark:text-indigo-500 dark:hover:text-indigo-700">Instant
                        quote
                        <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-24-hours w-10 h-10 mb-2 md:w-12 md:h-12" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 13c.325 2.532 1.881 4.781 4 6" />
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2" />
                    <path d="M4 5v4h4" />
                    <path d="M12 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2" />
                    <path d="M18 15v2a1 1 0 0 0 1 1h1" />
                    <path d="M21 15v6" />
                </svg>
                <h3 class="mb-2 text-2xl font-bold">24/7 support</h3>
                <p class="font-light text-gray-500">Our team are always available to assist our clients every step of
                    the way</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group w-10 h-10 mb-2 md:w-12 md:h-12" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                  </svg>
                <h3 class="mb-2 text-2xl font-bold">6k+ Users</h3>
                <p class="font-light text-gray-500">Trusted by over 6k users around the UK</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity w-10 h-10 mb-2 md:w-12 md:h-12" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
                </svg>
                <h3 class="mb-2 text-2xl font-bold">Lightening speed</h3>
                <p class="font-light text-gray-500">Get your order pricing with just few clicks</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bus w-10 h-10 mb-2 md:w-12 md:h-12" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                    <path d="M16 5l1.5 7l4.5 0" />
                    <path d="M2 10l15 0" />
                    <path d="M7 5l0 5" />
                    <path d="M12 5l0 5" />
                  </svg>
                <h3 class="mb-2 text-2xl font-bold">5000+ transportations</h3>
                <p class="font-light text-gray-500">Numerous completed transactions daily</p>
            </div>
        </div>
    </section>
    {{-- fixed background image --}}
    <section class="h-screen bg-cover bg-center bg-fixed" style="background-image: url('images/landing/trucks.jpg')">
    </section>
    {{-- testimonial --}}
    <section id="testimonials" aria-label="What our customers are saying"
        class="bg-slate-50 dark:bg-gray-800 py-20 sm:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl md:text-center">
                <h2 class="hedvig-regular tracking-wide text-coral text-3xl md:text-4xl lg:text-5xl">What Our
                    Customers Are Saying</h2>
            </div>
            <ul role="list"
                class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-6 sm:gap-8 lg:mt-20 lg:max-w-none lg:grid-cols-3">
                <li>
                    <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                        <li>
                            <figure
                                class="relative rounded-2xl bg-white dark:bg-gray-700 p-6 shadow-xl shadow-slate-900/10">
                                <svg aria-hidden="true" width="105" height="78"
                                    class="absolute left-6 top-6 fill-slate-100 dark:fill-slate-600">
                                    <path
                                        d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                    </path>
                                </svg>
                                <blockquote class="relative">
                                    <p class="text-lg tracking-tight text-slate-900 dark:text-white">
                                        {{ config('app.name') }} is the fastest and the most reliable logistics service
                                        we have ever used, no frills.‌</p>
                                </blockquote>
                                <figcaption
                                    class="relative mt-6 flex items-center justify-between border-t border-slate-100 dark:border-gray-600 pt-6">
                                    <div>
                                        <div class="font-semibold text-base text-slate-900 dark:text-white">Veron
                                            Nicolas - CEO at Protopter Inc.</div>
                                    </div>                                    
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                        <li>
                            <figure
                                class="relative rounded-2xl bg-white dark:bg-gray-700 p-6 shadow-xl shadow-slate-900/10">
                                <svg aria-hidden="true" width="105" height="78"
                                    class="absolute left-6 top-6 fill-slate-100 dark:fill-slate-600">
                                    <path
                                        d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                    </path>
                                </svg>
                                <blockquote class="relative">
                                    <p class="text-lg tracking-tight text-slate-900 dark:text-white">Working with
                                        {{ config('app.name') }} has been a game-changer for our business. Their
                                        efficient and reliable service has helped us meet our delivery deadlines
                                        consistently.</p>
                                </blockquote>
                                <figcaption
                                    class="relative mt-6 flex items-center justify-between border-t border-slate-100 dark:border-gray-600 pt-6">
                                    <div>
                                        <div class="font-semibold text-base text-slate-900 dark:text-white">Leland Keith
                                            - Operation Manager <br>at Smith & Co.</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                        <li>
                            <figure
                                class="relative rounded-2xl bg-white dark:bg-gray-700 p-6 shadow-xl shadow-slate-900/10">
                                <svg aria-hidden="true" width="105" height="78"
                                    class="absolute left-6 top-6 fill-slate-100 dark:fill-slate-600">
                                    <path
                                        d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                    </path>
                                </svg>
                                <blockquote class="relative">
                                    <p class="text-lg tracking-tight text-slate-900 dark:text-white">We've had the
                                        pleasure of partnering with {{ config('app.name') }} for several years now, and
                                        they never disappoint</p>
                                </blockquote>
                                <figcaption
                                    class="relative mt-6 flex items-center justify-between border-t border-slate-100 dark:border-gray-600 pt-6">
                                    <div>
                                        <div class="font-semibold text-base text-slate-900 dark:text-white">Frank
                                            Renolds - CEO of Bright Ideas Ltd</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>
    {{-- contact --}}
    <section class="py-12 dark:bg-gray-800">
        <div
            class="grid sm:grid-cols-2 items-center gap-16 p-8 mx-auto max-w-4xl bg-white dark:bg-gray-900 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md">
            <div>
                <h1 class="text-3xl font-extrabold text-coral dark:text-gray-200">Let's Talk</h1>
                <p class="text-sm text-gray-400 dark:text-gray-300 mt-3">Have some questions that need answers? Then
                    reach
                    out we'd love to hear about your inquiry and provide help.</p>
                <div class="mt-12">
                    <h2 class="text-lg font-extrabold dark:text-gray-200">Email</h2>
                    <ul class="mt-3">
                        <li class="flex items-center">
                            <div
                                class="bg-indigo-50 dark:bg-gray-600 h-10 w-10 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z">
                                    </path>
                                </svg>
                            </div>
                            <a target="blank" href="mailto:{{ config('mail.from.address') }}"
                                class="text-indigo-800 dark:text-gray-300 text-sm ml-3 hover:underline">
                                <small class="block">E-Mail</small>
                                <strong>{{ config('mail.from.address') }}</strong>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mt-12">
                    <h2 class="text-lg font-extrabold dark:text-gray-200">Socials</h2>
                    <ul class="flex mt-3 space-x-4">
                        <li
                            class="bg-indigo-50 dark:bg-gray-600 h-10 w-10 rounded-full flex items-center justify-center shrink-0">
                            <a href="{{ config('app.socials.whatsapp') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                                    </path>
                                </svg>
                            </a>
                        </li>
                       
                        <li
                            class="bg-indigo-50 dark:bg-gray-600 h-10 w-10 rounded-full flex items-center justify-center shrink-0">
                            <a href="{{ config('app.socials.instagram') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z">
                                    </path>
                                    <circle cx="16.806" cy="7.207" r="1.078"></circle>
                                    <path
                                        d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li
                            class="bg-indigo-50 dark:bg-gray-600 h-10 w-10 rounded-full flex items-center justify-center shrink-0">
                            <a href="{{ config('app.socials.linkedIn') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <circle cx="4.983" cy="5.009" r="2.188"></circle>
                                    <path
                                        d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                @livewire('contact-form')
            </div>
        </div>
    </section>
    {{-- subscribe newsletter --}}
    <div class="relative bg-indigo-900 dark:bg-gray-800">
        <div class="absolute inset-x-0 bottom-0">
            <svg viewBox="0 0 224 12" fill="currentColor" class="w-full -mb-1 text-white dark:text-gray-800"
                preserveAspectRatio="none">
                <path
                    d="M0,0 C48.8902582,6.27314026 86.2235915,9.40971039 112,9.40971039 C137.776408,9.40971039 175.109742,6.27314026 224,0 L224,12.0441132 L0,12.0441132 L0,0 Z">
                </path>
            </svg>
        </div>
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="relative max-w-2xl sm:mx-auto sm:max-w-xl md:max-w-2xl sm:text-center">
                <h2
                    class="hedvig-regular tracking-wide mb-6 text-3xl text-center font-bold tracking-tight text-white dark:text-gray-200 sm:text-4xl sm:leading-none">
                    Subscribe to our newsletter
                </h2>
                <p class="mb-6 text-base text-indigo-200 dark:text-gray-300 md:text-lg">
                    Stay up-to-date with the latest news coming out from {{ config('app.name') }} and the logistics
                    world generally. You can cancel your subscription at anytime
                    you want.
                </p>
                @livewire('subscribe')
                <p
                    class="max-w-lg mb-10 text-xs tracking-wide text-indigo-100 dark:text-gray-300 sm:text-sm sm:mx-auto md:mb-16">
                    Do you need to be in-touch with us face-to-face? <a href="{{ route('contact') }}"
                        class="underline uppercase text-sm font-semibold">contact us</a>
                </p>
                <a href="/" aria-label="Scroll down"
                    class="flex items-center justify-center w-10 h-10 mx-auto text-white duration-300 transform border border-gray-400 rounded-full hover:text-indigo-400 hover:border-indigo-400 hover:shadow hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                        fill="currentColor">
                        <path
                            d="M10.293,3.293,6,7.586,1.707,3.293A1,1,0,0,0,.293,4.707l5,5a1,1,0,0,0,1.414,0l5-5a1,1,0,1,0-1.414-1.414Z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    Livewire.on('contactedUs', () => {
        toastr.success('Thank you for reaching out to us!')
    })

    Livewire.on('subscribed', () => {
        toastr.success('Congratulations! You are now subscribed to our newsletter')
    })
</script>
