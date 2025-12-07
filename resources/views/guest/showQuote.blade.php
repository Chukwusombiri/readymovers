<x-app-layout>    
    <section class="pt-0 md:pt-16 pb-24 bg-gray-100 dark:bg-gray-800">
        <div class="px-0 md:px-8 lg:px-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="px-4 md:px-0 flex flex-col gap-6 order-2 lg:order-1">
                <h4 class="font-semibold text-2xl md:text-3xl dark:text-gray-200">Booking summary and fees</h4>
                <div class="w-full mb-4">
                    <h6 class="text-xl font-semibold dark:text-gray-300 mb-4 text-coral underline">Transport items</h6>
                    <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr class="">
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-gray-200 text-xs border-b-solid tracking-none whitespace-nowrap text-gray-600">Items</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-gray-200 text-xs border-b-solid tracking-none whitespace-nowrap text-gray-600">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveryItems as $item)
                                <tr>
                                    <td class="px-6 py-2 text-left align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">{{$item["name"]}}</td>
                                    <td class="px-6 py-2 text-left align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">{{$item["qty"] ?? ''}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="px-6 py-2 text-left align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap font-bold">Total items</td>
                                <td class="px-6 py-2 text-left align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap font-bold">{{count($deliveryItems)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="w-full">
                    <h6 class="text-xl font-semibold dark:text-gray-300 mb-4 text-coral underline">Transport expense</h6>
                    <ul class="divide-y divide-gray-300 list-none mb-6">
                        <li class="p-2 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                            <span class="flex flex-nowrap items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check size-6 mr-3" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                                Trip duration
                            </span>
                            <span class="">
                                {{$time}}
                            </span>
                        </li>
                        <li class="p-2 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                            <span class="flex flex-nowrap items-center"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check size-6 mr-3" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
                              </svg>Distance to be covered</span>
                            <span class="">{{$distance}}</span>
                        </li>                                                                
                    </ul>      
                </div> 
                <div class="w-full">
                    <h6 class="text-xl font-semibold dark:text-gray-300 mb-4 text-coral underline">Final cost of transportation</h6>
                    <ul class="divide-y divide-gray-300 list-none mb-6">
                        <li class="p-2 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                            <span class="font-semibold flex flex-nowrap items-center"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check size-6 mr-3" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
                              </svg>Total Cost <span class="font-light text-sm ml-2">(VAT included)</span></span>
                            <span class="font-serif">£{{$quote}}</span>
                        </li>    
                        <li class="p-2 text-gray-700 dark:text-gray-300 flex justify-between items-center">
                            <span class="font-semibold flex flex-nowrap items-center"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check size-6 mr-3" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
                              </svg>Amount to pay <span class="font-light text-sm ml-2">(Reservation fee)</span></span>
                            <span class="font-semibold font-serif text-lg">£{{$upfront_fee}}</span>
                        </li>
                    </ul>
                </div>  
                <form action="{{route('checkout.create')}}" method="post">
                    @csrf           
                    <button type="submit" x-data="{mouseOver: false}" @mouseenter="mouseOver=true" @mouseleave="mouseOver=false" class="w-full px-4 py-3 lg:px-6 lg:py-6 text-gray-200 rounded-xl bg-coral hover:bg-orange-700 active:bg-orange-700 font-semibold text-xs lg:text-sm uppercase flex items-center justify-between">
                        Proceed to pay £{{$upfront_fee}}
                        <span class="text-gray-100" :class="{'translate-x-2 duration-300':mouseOver}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="hidden md:inline-flex icon icon-tabler icon-tabler-arrow-badge-right-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 6l-.112 .006a1 1 0 0 0 -.669 1.619l3.501 4.375l-3.5 4.375a1 1 0 0 0 .78 1.625h6a1 1 0 0 0 .78 -.375l4 -5a1 1 0 0 0 0 -1.25l-4 -5a1 1 0 0 0 -.78 -.375h-6z" stroke-width="0" fill="currentColor" />
                            </svg>  
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex md:hidden icon icon-tabler icon-tabler-chevron-right" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 6l6 6l-6 6" />
                            </svg>                        
                        </span>
                    </button>
                </form>
                <div class="flex justify-center">
                    <a href="{{route('personalDetails')}}" x-data="{mouseOver: false}" @mouseenter="mouseOver=true" @mouseleave="mouseOver=false"
                        class="inline-flex items-center outline-none border-none text-center font-semibold dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'-translate-x-2':mouseOver}" class="icon icon-tabler icon-tabler-arrow-narrow-left dark:text-white transition duration-300 hover:text-gray-700 dark:hover:text-gray-300" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M5 12l4 4" />
                            <path d="M5 12l4 -4" />
                        </svg> Back
                    </a> 
                </div>
            </div>
            <div id="map" class="h-[60vh] shadow order-1 lg:order-2"></div>
        </div>        
    </section>
</x-app-layout>
<script>
    mapboxgl.accessToken =
        {!!json_encode(config('app.mapbox_token'))!!};
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: {!! json_encode($pickUpCoordinates) !!}, // starting position
        zoom: 15
    });        

    // an arbitrary start will always be the same
    // only the end or destination will change
    const start = {!! json_encode($pickUpCoordinates) !!};

    // this is where the code for the next step will go
    // create a function to make a directions request
    async function getRoute() {        
        const route = {!! json_encode($geometry) !!};
        const geojson = {
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: route
            }
        };
        // if the route already exists on the map, we'll reset it using setData
        if (map.getSource('route')) {
            map.getSource('route').setData(geojson);
        }
        // otherwise, we'll make a new request
        else {
            map.addLayer({
                id: 'route',
                type: 'line',
                source: {
                    type: 'geojson',
                    data: geojson
                },
                layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                paint: {
                    'line-color': '#3887be',
                    'line-width': 5,
                    'line-opacity': 0.75
                }
            });
        }
        // add turn instructions here at the end
    }

    function setMapStyle(isDarkMode) {
        const style = isDarkMode ? 'mapbox://styles/mapbox/dark-v10' : 'mapbox://styles/mapbox/streets-v12';
        map.setStyle(style);
    }

    // Initial setup
    const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setMapStyle(prefersDarkMode);

    // Listen for changes in system theme
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
        setMapStyle(event.matches);
    });

    map.on('load', () => {
        // make an initial directions request that
        // starts and ends at the same location
        getRoute();

        // Add starting point to the map
        map.addLayer({
            id: 'point',
            type: 'circle',
            source: {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [{
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'Point',
                            coordinates: start
                        }
                    }]
                }
            },
            paint: {
                'circle-radius': 10,
                'circle-color': '#3887be'
            }
        });
        // this is where the code from the next step will go
    });    
</script>