<x-app-layout>
    {{-- header --}}
    <section class="relative"
        style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/services/hero.jpg') no-repeat center;background-size:cover">
        <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-16 max-w-7xl lg:py-24">
            <div class="flex w-full mx-auto text-left">
                <div class="relative inline-flex items-center mx-auto align-middle">
                    <div class="text-center">
                        <h1
                            class="max-w-5xl text-2xl font-bold leading-none tracking-tighter text-gray-100 text-shadow-md md:text-5xl lg:text-6xl lg:max-w-7xl dark:text-white">
                            Explore our services
                        </h1>
                        <p
                            class="max-w-xl mx-auto mt-8 text-md md:text-lg font-semibold leading-relaxed text-gray-100 dark:text-gray-300 hidden md:block">
                            At
                            {{config('app.name')}}, we redefine efficiency in moves to propel your business
                            forward.</p>
                        <div class="flex justify-center w-full max-w-2xl gap-2 mx-auto mt-6">
                                <x-link href="{{ route('quote') }}" class="mt-3 sm:mt-0 py-4">
                                    Get instant quote
                                </x-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- service items --}}
    <section class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="border-b mb-6 md:mb-8 flex justify-between text-sm">
            <div class="flex items-center pb-2 pr-2 border-b-2 border-coral uppercase">                
                <a href="{{ route('quote') }}"
                    class="font-semibold inline-block text-coral md:text-3xl lg:text-4xl dark:text-white">Our
                    services</a>
            </div>
        </div>
        {{-- grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            <!-- CARD 1 -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col bg-white dark:bg-gray-800">
                <div class="relative">
                    <a href="{{ route('quote') }}">
                        <img class="w-full h-52" src="{{ url('images/services/home.jpg') }}" alt="Service 1">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4 mb-auto hover:underline">
                    <a href="{{ route('quote') }}"
                        class="font-medium text-lg inline-block text-coral hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">Home
                        Moves</a>
                    <p class="text-gray-500 text-sm">
                        Streamline your relocation process with our efficient and reliable home moving service.
                    </p>
                </div>
            </div>
            <!-- CARD 2 -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col bg-white dark:bg-gray-800">
                <div class="relative">
                    <a href="{{ route('contact') }}">
                        <img class="w-full h-52" src="{{ url('images/services/large.jpg') }}" alt="Service 1">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4 mb-auto hover:underline">
                    <a href="{{ route('contact') }}"
                        class="font-medium text-lg inline-block text-coral hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">Large
                        items Delivery</a>
                    <p class="text-gray-500 text-sm">
                        Trust us to handle the transportation of your bulky items securely and promptly. Contact our team to discuss your specific needs.
                    </p>
                </div>
            </div>
            <!-- CARD 5 -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col bg-white dark:bg-gray-800">
                <div class="relative">
                    <a href="{{ route('quote') }}">
                        <img class="w-full h-52" src="{{ url('images/services/waste.jpg') }}" alt="Service 1">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4 mb-auto hover:underline">
                    <a href="{{ route('quote') }}"
                        class="font-medium text-lg inline-block text-coral hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">Commercial
                        Waste</a>
                    <p class="text-gray-500 text-sm">
                        Ensure eco-friendly disposal of your commercial waste with our specialized transportation
                        solutions. To start moving, get in touch with us today to discuss specifics.
                    </p>
                </div>
            </div>
            <!-- CARD 7 -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col bg-white dark:bg-gray-800">
                <div class="relative">
                    <a href="{{ route('quote') }}">
                        <img class="w-full h-52" src="{{ url('images/services/european.jpg') }}" alt="Service 1">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4 mb-auto hover:underline">
                    <a href="{{ route('quote') }}"
                        class="font-medium text-lg inline-block text-coral hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">European
                        moves</a>
                    <p class="text-gray-500 text-sm">
                        Seamlessly transition to your new destination in Europe with our expert migration services from
                        the UK.
                    </p>
                </div>
            </div>
            <!-- CARD 9 -->
            <div class="rounded overflow-hidden shadow-lg flex flex-col bg-white dark:bg-gray-800">
                <div class="relative">
                    <a href="{{ route('contact') }}">
                        <img class="w-full h-52" src="{{ url('images/services/custom.jpg') }}" alt="Service 1">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4 mb-auto hover:underline">
                    <a href="{{ route('contact') }}"
                        class="font-medium text-lg inline-block text-coral hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-2">Clearance Services</a>
                    <p class="text-gray-500 text-sm">
                        {{config('app.name')}} simplifies clearance operations, making it effortless to clear out your home, storage spaces, or garage and seamlessly transition your belongings into your new space.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- testimonials --}}
    <section class="bg-neutral-300 dark:bg-gray-800 mt-20">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-24 lg:px-6">
            <figure class="max-w-screen-md mx-auto">
                <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                        fill="currentColor"></path>
                </svg>
                <blockquote>
                    <p class="text-xl font-medium text-gray-900 md:text-2xl dark:text-white">
                        "Working with Mazmoves Logistics has been an absolute game-changer for our company. Their supply
                        chain management service has exceeded all expectations, optimizing our operations and enhancing
                        our efficiency tenfold. From seamless inventory management to timely deliveries, Mazmoves
                        Logistics has truly transformed the way we do business. Their attention to detail and commitment
                        to excellence are unparalleled. I highly recommend them to any company looking to elevate their
                        logistics game."</p>
                </blockquote>
                <figcaption class="flex items-center justify-center mt-6 space-x-3">
                    <img class="w-6 h-6 rounded-full"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png"
                        alt="profile picture">
                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                        <div class="pr-3 font-medium text-gray-900 dark:text-white">Alexander Morgan</div>
                        <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">CEO at GenTech Solutions
                            Ltd</div>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>
    {{-- contact-us CTA --}}
    <section class="py-12 md:py-24 bg-white dark:bg-gray-800">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 relative">
            <div class="shadow rounded-xl relative">
                <div
                    class="grid overflow-hidden text-white shadow-xl md:grid-cols-2 bg-indigo-900 dark:bg-gray-900 rounded-xl">
                    <div class="p-8 space-y-4 md:p-16">
                        <h2 class="text-2xl font-bold tracking-tight md:text-4xl font-headline">
                            Ready to move a parcel today?.
                        </h2>

                        <p class="font-medium text-indigo-50 md:text-2xl">
                            Get in-touch with us to discuss your needs.
                        </p>

                        <div>
                            <x-link href="{{ route('contact') }}" class="font-semibold">
                                Contact us <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodiv"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodiv"></path>
                                </svg>
                            </x-link>
                        </div>
                    </div>

                    <div class="relative hidden md:block">
                        <img class="absolute inset-0 object-cover object-left-top w-full h-full mt-16 -mr-16 rounded-tl-lg"
                            src="{{ url('images/services/support.jpg') }}" alt="support photo">
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
