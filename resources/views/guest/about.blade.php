<x-app-layout>
    {{-- hero --}}
    <section class="py-24 dark:text-white">
        <div class="container px-6 grid grid-cols-1 lg:grid-cols-2 max-w-5xl mx-auto">
            <div class="flex">
                <div class="max-w-lg mx-auto mb-10 lg:mb-0 flex flex-col items-center justify-center lg:items-start lg:justify-start">
                    <h1 class="hedvig-bold tracking-wide text-4xl text-gray-800 md:text-5xl lg:text-6xl dark:text-white">About {{ config('app.name') }}</h1>
                    <p class="my-6 text-gray-500 dark:text-gray-300">We are your trusted partner in delivering solutions that exceed expectations, every step of the way.</p>
                    <div class="w-full">
                        <x-link href="{{ route('contact') }}">contact us</x-link>
                    </div>
                </div>        
            </div>
            <div class="relative flex justify-center max-w-4xl mx-auto h-[60vh]">
                <img class="w-full h-full object-cover rounded-xl" src="{{asset('images/about/hero.jpg')}}" alt="about us image" />
            </div>
        </div>       
    </section>    
    {{-- intro --}}
    {{-- <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="lg:flex lg:items-center">
                <div class="w-full space-y-12 lg:w-1/2">
                    <div>
                        <h1 class="text-2xl font-semibold text-coral capitalize lg:text-3xl dark:text-white">Who we are</h1>
    
                        <div class="mt-2">
                            <span class="inline-block w-40 h-1 bg-indigo-800 rounded-full"></span>
                            <span class="inline-block w-3 h-1 ml-1 bg-indigo-800 rounded-full"></span>
                            <span class="inline-block w-1 h-1 ml-1 bg-indigo-800 rounded-full"></span>
                        </div>
                    </div>
    
                    <div class="md:-mx-4">
                        <div class="mt-4 md:mx-4 md:mt-0">
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                At {{ config('app.name') }}, we are more than just a logistics company. With a commitment to reliability, efficiency, and customer satisfaction, we've built a reputation as a leading logistics provider in the UK having Company Registration Number: <b>{{ config('app.regNo') }}</b>
                            </p>
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                Our experienced team understands that moving can be a stressful experience. That's why we offer a wide range of services, from long-distance and short-distance moves to meticulous inventory management. We also specialize in assisting new businesses with efficient parcel fulfillment, ensuring your products reach your customers swiftly and securely.
                            </p>
                        </div>
                    </div>
    
                    <div class="md:-mx-4">
                        <div class="mt-4 md:mx-4 md:mt-0">
                            <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Our mission</h1>
    
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                Our mission is simple: to streamline logistics processes, empower businesses, and create seamless experiences for our clients. We strive to deliver excellence in every aspect of our operations, ensuring that your shipments arrive safely, on time, and in perfect condition.
                            </p>
                        </div>
                    </div>
    
                    <div class="mt-10 space-y-8 text-base leading-7 text-gray-700 dark:text-gray-300">
                        <div class="relative pl-9">
                            <div class="inline font-semibold text-gray-900"><svg class="absolute left-1 top-1 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(55, 48, 163, 1);transform: ;msFilter:;"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg>Reliability</div>
                            <div class="inline">We go above and beyond to ensure that your transportation items are handled with care and delivered with precision, every time.</div>
                        </div>
                        <div class="relative pl-9">
                            <div class="inline font-semibold text-gray-900"><svg class="absolute left-1 top-1 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(55, 48, 163, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="m8 16 5.991-2L16 8l-6 2z"></path></svg>Innovation</div>
                            <div class="inline">From cutting-edge technology to sustainable practices, we continuously seek new ways to improve our services and minimize our environmental footprint.</div>
                        </div>
                        <div class="relative pl-9">
                            <div class="inline font-semibold text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(55, 48, 163, 1);transform: ;msFilter:;"><circle cx="12" cy="12" r="4"></circle><path d="M13 4.069V2h-2v2.069A8.01 8.01 0 0 0 4.069 11H2v2h2.069A8.008 8.008 0 0 0 11 19.931V22h2v-2.069A8.007 8.007 0 0 0 19.931 13H22v-2h-2.069A8.008 8.008 0 0 0 13 4.069zM12 18c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z"></path></svg>Customer Focus</div>
                            <div class="inline">Your satisfaction is our priority. We believe in building long-lasting relationships with our clients by providing personalized solutions, responsive support, and unparalleled attention to detail.</div>
                        </div>
                    </div>
                </div>
    
                <div class="hidden lg:flex lg:items-center lg:w-1/2 lg:justify-center">
                    <img class="w-[28rem] h-[28rem] object-cover xl:w-[34rem] xl:h-[34rem]" src="{{ url('images/about/who_we_are.jpg') }}" alt="About-us vector illustration">
                </div>
            </div>
        </div>
    </section> --}}    
    {{-- stats --}}
    <section class="bg-white dark:bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <div class="text-center">
                    <h2 class="hedvig-regular tracking-wide text-3xl text-coral md:text-4xl lg:text-5xl dark:text-white">Our stats speaks louder</h2>
                    <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300 mx-auto max-w-3xl">
                        Under a very short time span, we've been able to hit some excellent milestones owing to our dedicated working tirelessly to 
                        uphold our values meanwhile delivering top-notch services.
                    </p>
                </div>
                <div class="container mx-auto mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 mt-10 text-gray-800 dark:text-gray-200">
                    <div class="flex flex-col justify-start py-6 md:border-t border-gray-300 dark:border-gray-500">
                        <h4 class="hedvig-bold text-coral text-5xl md:text-6xl">
                            6,000+
                        </h4>
                        <p class="text-lg md:text-2xl mt-2 md:mt-4">
                            Satisfied clients
                        </p>
                    </div>
                    <div class="flex flex-col justify-start py-6 border-t border-gray-300 dark:border-gray-500">
                        <h4 class="hedvig-bold text-coral text-5xl md:text-6xl flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-pound w-20 h-20" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M17 18.5a6 6 0 0 1 -5 0a6 6 0 0 0 -5 .5a3 3 0 0 0 2 -2.5v-7.5a4 4 0 0 1 7.45 -2m-2.55 6h-7" />
                            </svg>5.6M+
                        </h4>
                        <p class="text-lg md:text-2xl mt-2 md:mt-4">
                            Customer money saved
                        </p>
                    </div>
                    <div class="flex flex-col justify-start py-6 border-t border-gray-300 dark:border-gray-500">
                        <h4 class="hedvig-bold text-coral text-5xl md:text-6xl">
                            5x lower
                        </h4>
                        <p class="text-lg md:text-2xl mt-2 md:mt-4">
                            Less fees than the average
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    {{-- faqs --}}
    <section class="md:py-16">
        <div class="relative w-full bg-white dark:bg-gray-900 px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-2xl sm:rounded-lg sm:px-10">
            <div class="mx-auto px-5">
                <div class="flex flex-col items-center">
                    <h2 class="hedvig-regular tracking-wide mt-5 text-center text-3xl md:text-4xl lg:text-5xl text-coral dark:text-white">Frequently asked questions</h2>
                    <p class="mt-3 text-lg text-neutral-500 md:text-xl dark:text-gray-300">Read some of our most frequently asked questions, feel free to reach out to us today. <a href="{{route('contact')}}" class="text-indigo-800 font-semibold text-sm underline">Contact us.</a></p>
                </div>
                <div class="mx-auto mt-8 grid max-w-xl divide-y divide-neutral-200">
                    @foreach ($faqArr as $faq)
                    <div class="py-5">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                                <span class="text-coral">{{$faq['question']}}</span>
                                <span class="transition group-open:rotate-180 text-coral">
                                    <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                        <path d="M6 9l6 6 6-6"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="group-open:animate-fadeIn mt-3 text-neutral-600 dark:text-gray-300">
                                {{$faq['answer']}}
                            </p>
                        </details>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </section>       
    {{-- reviews cta --}}
    {{-- <div class="relative py-16">
        <div aria-hidden="true" class="absolute inset-0 h-max w-full m-auto grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20">
            <div class="blur-[106px] h-56 bg-gradient-to-br from-teal-500 to-purple-400 dark:from-indigo-700"></div>
            <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
            <div class="relative">
    
                <div class="flex items-center justify-center -space-x-2">
                    <img loading="lazy" width="400" height="400" src="https://randomuser.me/api/portraits/women/12.jpg" alt="member photo" class="h-8 w-8 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://randomuser.me/api/portraits/women/45.jpg" alt="member photo" class="h-12 w-12 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://randomuser.me/api/portraits/women/60.jpg" alt="member photo" class="z-10 h-16 w-16 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://randomuser.me/api/portraits/women/4.jpg" alt="member photo" class="relative h-12 w-12 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://randomuser.me/api/portraits/women/34.jpg" alt="member photo" class="h-8 w-8 rounded-full object-cover">
                </div>
    
                <div class="mt-6 m-auto space-y-6 md:w-8/12 lg:w-7/12">
                    <h1 class="text-center text-4xl font-bold text-gray-800 dark:text-white md:text-5xl">Already used our services?</h1>
                    <p class="text-center text-xl text-gray-600 dark:text-gray-300">Be part of thousands of people who have made us know how they feel about our services</p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <x-link href="{{route('review').'#comment'}}">
                            <span class="relative text-base font-semibold text-white dark:text-dark">Leave a review</span>
                        </x-link>
                        <a href="{{route('review')}}" class="relative flex items-center justify-center px-8 before:absolute before:inset-0 hover:underline hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                            <span class="relative text-base font-semibold text-indigo-800">View all reviews</span>
                            <svg class="w-5 h-5 ml-1 text-indigo-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
