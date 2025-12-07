<x-app-layout>
    {{-- header --}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/contact/agents.jpg') no-repeat center;background-size:cover">
        <div class="relative isolate overflow-hidden px-6 py-20 text-center sm:px-16 sm:shadow-sm dark:bg-transparent">
            <p class="text-base montserrat-semilight uppercase tracking-wide text-coral">
                Contact
            </p>
            <h2 class="hedvig-bold tracking-wide mb-4 font-bold tracking-tight text-gray-200 text-4xl md:text-5xl lg:text-6xl dark:text-white">
                Get in Touch
            </h2>
            <p class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-gray-100 dark:text-gray-200 sm:text-4xl">
                Are you ready to get started?
            </p>
        </div>
    </div>
    {{-- main --}}
    <section class="bg-blue-50 dark:bg-slate-800" id="contact">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="flex items-stretch justify-center">
                <div class="grid md:grid-cols-2">
                    <div class="h-full pr-6">
                        <p class="mt-3 mb-12 text-lg text-gray-600 dark:text-slate-400">
                            Readily get in touch with us through any of these channels. We are always eager to answer
                            any questions and
                            solve your problems.
                        </p>
                        <ul class="mb-6 md:mb-0">
                            <li class="flex">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-coral text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path
                                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">Our
                                        Address
                                    </h3>
                                    <p class="text-gray-600 dark:text-slate-400">{{config('app.company_address')}}</p>
                                    <p class="text-gray-600 dark:text-slate-400">United Kingdom</p>
                                </div>
                            </li>
                            <li class="flex">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-coral text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                        </path>
                                        <path d="M15 7a2 2 0 0 1 2 2"></path>
                                        <path d="M15 3a6 6 0 0 1 6 6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">Contact
                                    </h3>
                                    <p class="text-gray-600 dark:text-slate-400"><a href="tel:{{ config('app.phone') }}"
                                            class="hover:underline">Mobile: {{ config('app.phone') }}</a></p>
                                    <p class="text-gray-600 dark:text-slate-400"><a
                                            href="{{ config('app.socials.whatsapp') }}"
                                            class="hover:underline">Whatsapp: {{ config('app.phone') }}</a></p>
                                    <p class="text-gray-600 dark:text-slate-400"><a
                                            href="mailto:{{ config('mail.reply_to.address') }}"
                                            class="hover:underline">E-Mail: {{ config('mail.reply_to.address') }}</a></p>
                                </div>
                            </li>
                            <li class="flex">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-coral text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 7v5l3 3"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">Working
                                        hours</h3>
                                    <p class="text-gray-600 dark:text-slate-400">Monday - Friday: 08:00 - 17:00</p>
                                    <p class="text-gray-600 dark:text-slate-400">Saturday &amp; Sunday: 08:00 - 12:00
                                    </p>
                                </div>
                            </li>
                            <li class="flex">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-coral text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-certificate" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                                        <path
                                            d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                                        <path d="M6 9l12 0" />
                                        <path d="M6 12l3 0" />
                                        <path d="M6 15l2 0" />
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                        Organization Registration</h3>
                                    <p class="text-gray-600 dark:text-slate-400">Registered in England and Wales:
                                        {{ config('app.regNo') }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card h-fit max-w-6xl p-5 md:p-12" id="form">
                        <h2 class="mb-4 text-2xl font-bold dark:text-gray-100">Send in your inquiries now</h2>
                        @livewire('contact-form');
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
<script>
    Livewire.on('contactedUs', () => {
        toastr.success('Thank you for reaching out to us!')
    })
</script>
