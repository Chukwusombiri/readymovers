<div class="flex flex-col md:flex-row items-center md:items-start">
    <div class="w-full md:w-1/2">
        @if (session()->has('error'))
            <div class="my-8 bg-rose-100 text-rose-800 p-4 dark:bg-rose-700 dark:text-rose-300">
                {{ session('error') }}
            </div>
        @endif
        @if ($allItems && count($allItems) > 0)
            <div class="mb-5">
                <label for="inputItems" class="mb-3 block text-lg font-medium text-gray-800 dark:text-white">
                    Choose your items
                </label>
                @error('inputItems')
                    <p class="text-rose-600 p-2 text-sm dark:text-rose-300">{{ $message }}</p>
                @enderror
                <div class="mt-5 flex flex-wrap items-start">
                    @foreach ($allItems as $element)
                        <div class="max-w-md pt-2 pb-2 pr-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="{{ $element->name }}" class="hidden peer"
                                    @if (in_array($element->id, array_keys($inputItems))) {{ 'checked' }} @endif />
                                <label wire:click='tryValue("{{ $element->id }}")' for="{{ $element->name }}"
                                    class="select-none cursor-pointer flex items-center justify-center rounded-lg border border-gray-300
                            py-2 px-4 font-semibold text-gray-700 text-sm transition-colors duration-200 ease-in-out peer-checked:bg-gray-300 peer-checked:text-gray-900 peer-checked:border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                    <span>{{ $element->name }}</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="hidden"></div>
        @endif
    </div>
    <div class="w-full md:w-1/2">
        <h2 class="font-semibold text-xl text-gray-800 mb-4 dark:text-white">Selected Items</h2>
        <div class="bg-white rounded-lg shadow-md p-6 mb-4 dark:bg-gray-600 overflow-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left font-semibold text-sm text-slate-500 dark:text-gray-300">Item </th>
                        <th class="text-center font-semibold text-sm text-slate-500 dark:text-gray-300">Quantity</th>
                        <th class="text-left font-semibold text-sm text-slate-500 dark:text-gray-300"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inputItems as $item => $itemDetails)
                        <tr class="border-b border-gray-300 dark:border-gray-400">
                            <td class="py-4">
                                <div class="flex items-center">
                                    <span class="dark:text-gray-300 sm:text-sm text-lg font-semibold">{{ $itemDetails['name'] }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="w-full flex items-center justify-center">
                                    @if ($itemDetails['qty'] !== null)
                                        <button wire:click='reduceQty("{{ $item }}")'
                                            class="py-2 px-4 ml-1 mr-2 dark:text-gray-100 font-semibold sm:text-sm text-lg hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg border"
                                            @if ($itemDetails['qty'] == 1) {{ 'disabled' }} @endif>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M5 12l14 0" />
                                              </svg>
                                        </button>
                                        <span class="text-center w-8 dark:text-gray-300 font-semibold sm:text-sm text-lg">{{ $itemDetails['qty'] }}</span>
                                        <button wire:click='incrementQty("{{ $item }}")'
                                            class="py-2 px-4 ml-2 dark:text-gray-100 font-semibold sm:text-sm text-lg hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg border">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus w-6 h-6" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                              </svg></button>
                                    @else
                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-minus" class="h-5 w-5"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l14 0" />
                                            </svg></span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4">
                                <button wire:click='removeItem("{{ $item }}")'
                                    class="py-2 px-4 hover:bg-gray-200 dark:bg-gray-700 rounded-lg dark:hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash w-6 h-6" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                      </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More product rows -->
                </tbody>
            </table>            
        </div>  
        <div>
            <button wire:click="submitStep1"
                class="bg-coral hover:bg-orange-700 active:bg-orange-700 w-full rounded-md py-3 px-8 text-center text-base font-semibold text-white outline-none dark:bg-coral dark:hover:bg-orange-700 dark:text-white">
                Next step
            </button>
        </div>
    </div>      
</div>