<x-app-layout>
    {{-- hero --}}
    <section class="mx-auto max-w-7xl sm:px-6 lg:px-8" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/tracker/hero.jpg') no-repeat center;background-size:cover">
        <div class="relative isolate overflow-hidden px-6 py-20 text-center sm:px-16 sm:shadow-sm dark:bg-transparent">
            <p class="hedvig-bold tracking-wide mx-auto max-w-2xl text-4xl font-bold tracking-tight text-gray-100 dark:text-gray-200 md:text-5xl lg:text-6xl">
                Already moving your items with us? 
            </p>
            {{-- tracker --}}
            @livewire('tracker')                
        </div>
    </section>
    {{-- CTAs --}}
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-24 mx-auto">
            <div class="lg:flex lg:items-center">
                <div class="w-full space-y-12 lg:w-1/2 ">
                    <div>
                        <h1 class="hedvig-regular tracking-wide text-3xl md:text-4xl lg:text-5xl text-coral">Let's help you make <br> moving things a cinch</h1>                        
                    </div>
    
                    <div class="md:flex md:items-start md:-mx-4">
                        <span class="inline-block p-2 text-indgo-500 bg-indigo-100 rounded-xl md:mx-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(49, 46, 129, 1);transform: ;msFilter:;"><path d="M13.707 3.293A.996.996 0 0 0 13 3H4a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l8 8a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-8-8zM12 19.586l-7-7V5h7.586l7 7L12 19.586z"></path><circle cx="8.496" cy="8.495" r="1.505"></circle></svg>
                        </span>
    
                        <div class="mt-4 md:mx-4 md:mt-0">
                            <a href="{{route('quote')}}" class="flex items-center hover:underline text-xl font-semibold text-gray-700 capitalize dark:text-white">Get instant quote<svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodiv"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodiv"></path>
                            </svg></a>
    
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                Calculate your logistics costs instantly with our easy-to-use quote tool. Simply enter your details and receive a personalized quote in seconds.
                            </p>
                        </div>
                    </div>
    
                    <div class="md:flex md:items-start md:-mx-4">
                        <span class="inline-block p-2 bg-indigo-100 rounded-xl md:mx-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
    
                        <div class="mt-4 md:mx-4 md:mt-0">
                            <a href="{{route('services')}}" class="flex items-center hover:underline text-xl font-semibold text-gray-700 capitalize dark:text-white">Explore our services<svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodiv"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodiv"></path>
                            </svg></a>                            
    
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                Discover the wide range of logistics solutions we offer, from home moves to supply chain management.
                            </p>
                        </div>
                    </div>
    
                    <div class="md:flex md:items-start md:-mx-4">
                        <span class="inline-block p-2 bg-indigo-100 rounded-xl md:mx-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(49, 46, 129, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4 1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10z"></path></svg>
                        </span>
    
                        <div class="mt-4 md:mx-4 md:mt-0">
                            <a href="{{route('contact')}}" class="flex items-center hover:underline text-xl font-semibold text-gray-700 capitalize dark:text-white">Get in touch<svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodiv"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodiv"></path>
                            </svg></a>
    
                            <p class="mt-3 text-gray-500 dark:text-gray-300">
                                Have questions or need assistance? Contact our friendly team today for expert advice and support.
                            </p>
                        </div>
                    </div>
                </div>
    
                <div class="lg:w-1/2 flex items-center lg:justify-center">
                    <img class="w-[28rem] h-[28rem] object-cover xl:w-[34rem] xl:h-[34rem]" src="{{url('images/tracker/delivery5.jpg')}}" alt="Logistics vector illustration">
                </div>
            </div>                
        </div>
    </section>
</x-app-layout>
