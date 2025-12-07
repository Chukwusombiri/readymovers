<x-app-layout>
    <section class="pt-16 pb-24 px-4 md:px-6 lg:px-12 bg-gray-100 dark:bg-gray-900">
        <h1 id="quote-heading" class="text-3xl md:text-4xl lg:text-5xl font-bold text-coral dark:text-coral mb-6 lg:mb-8" style="white-space: normal; overflow-wrap: break-word; word-wrap: break-word; overflow: hidden;"></h1>
        <div class="flex items-center justify-center">
            <div class="mx-auto w-full max-w-6xl">
                <div class="space-y-2 bg-gray-100 dark:bg-transparent text-gray-800 dark:text-white">
                    <h3 class="text-2xl font-semibold">Step 1: What are you moving?</h3>
                    <div class="flex gap-3">
                        <span class="w-20 h-2 rounded-sm bg-slate-800 dark:bg-gray-300"></span>
                        <span class="w-20 h-2 rounded-sm bg-gray-300 dark:bg-gray-300"></span>
                        <span class="w-20 h-2 rounded-sm bg-gray-300 dark:bg-gray-300"></span>
                    </div>
                </div>

                <div class="pt-10">
                    @livewire('delivery-items-details', ['sentItem' => $selectedItem ?? null])
                </div>
            </div>
        </div>
    </section>
    <section class="pt-16 pb-12 bg-white dark:bg-gray-800">
        <div class="px-4 md:px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2">
            <div class="flex flex-col gap-10">   
                <h2 class="text-2xl md:text-3xl font-bold text-coral dark:text-coral" style="white-space: normal; overflow-wrap: break-word; word-wrap: break-word; overflow: hidden;">Move house with a highly-rated removal company</h2>             
                <div>                    
                    <p id="quote-description" class="text-md md:text-lg lg:text-xl max-w-3xl font-semibold  dark:text-gray-300">
                        Receive quick, affordable quotes for local house moves, removals, and dependable man-with-a-van services. Whether you’re moving domestically or internationally, we offer comprehensive packages, including box supplies, packing, and transportation. Trust us to deliver a seamless, stress-free moving experience tailored to your needs.
                    </p>
                </div>
                <div>
                    <x-link href="{{ route('contact') }}">
                        Get in touch
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M15 16l4 -4" />
                            <path d="M15 8l4 4" />
                        </svg>
                    </x-link>
                </div>
            </div>
            <div class="flex overflow-hidden lg:pl-10 mt-12 lg:mt-0">
                <img src="{{asset('images/services/european.jpg')}}" alt="homes moves image" class="w-full h-96 object-fit ">
            </div>
        </div>        
    </section>
    <section class="pt-16 pb-24">
        <div class="px-4 md:px-6 lg:px-12 bg-gray-100 dark:bg-gray-900 flex flex-col gap-6 md:gap-8">
            <h2 class="text-3xl font-semibold max-w-5xl mb-4 dark:text-gray-200">Our trusted partners</h2>
            <div class="flex flex-wrap justify-start items-center gap-6 md:gap-8 lg:gap-12">
                @foreach ($partners as $partner)
                    <div class="flex flex-col items-center">
                        <a href="{{ $partner['url'] }}" title="{{ $partner['description'] }}"
                            class="rounded-full h-32 w-32 flex overflow-hidden  @if ($partner['name'] == 'Howdens') bg-[#c20116] @endif">
                            <img src="{{ $partner['imgUrl'] }}" alt="{{ $partner['name'] }} logo"
                                class="w-full h-full object-fit">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
<script>
    const quoteHeader = document.querySelector('#quote-heading');
    const quoteDesc = document.getElementById('quote-description');

    function pushText(nodeItem,duration,txt){
        const txtArray = (txt).split("");
        let current = 0;

        const intervalId = setInterval(() => {
            if (current < txtArray.length){
                if(txtArray[current]==='Q')nodeItem.innerHTML += '<br/>';
                nodeItem.innerHTML += txtArray[current] === " " ? "&nbsp;" : txtArray[current];                
                current++;
            }else {
                clearInterval(intervalId);
                nodeItem.style.whiteSpace = 'normal';
            }
        }, duration);
    }   
    
    pushText(quoteHeader,100,'Instant House Move Quote');
    // pushText(quoteDesc,10)

    Livewire.on('invalidOperation', () => {
        toastr.error('Invalid operation! Something went wrong.')
    })
</script>
