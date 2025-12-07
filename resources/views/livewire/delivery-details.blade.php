<div>
    <div class="mb-5 pt-3">
        <label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl dark:text-white">
            Pick-up Address Details
        </label>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3">
                <div class="mb-5 relative">
                    <input type="text" wire:model="pickUpAddress" id="pickUpAddress" placeholder="Enter address"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300" />
                    <x-input-error for="pickUpAddress" />
                    @if (count($pickSuggestions) > 0)
                        <div id="pickSuggestionList"
                            class="absolute top-full z-10 bg-white dark:bg-gray-900 dark:text-gray-100 w-full border border-gray-300 mt-1 rounded-md shadow-md py-4">
                            @foreach ($pickSuggestions as $s => $suggest)
                                <button type="button" wire:click="setAddress('{{ $s }}','pickUpAddress')"
                                    class="block w-full py-1 px-4 text-start outline-none border-none hover:bg-gray-200 dark:hover:bg-gray-700">{{ $suggest['address'] }}</button>
                            @endforeach
                        </div>
                    @else
                        <div id="pickSuggestionList" class="hidden"></div>
                    @endif
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <input type="text" wire:model="pickUpPostCode" id="pickUpPostCode" placeholder="Post Code"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300" />
                    <x-input-error for="pickUpPostCode" />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <select wire:model="pickUpFloor"
                        id="pickUpFloor"class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600">
                        <option value="">choose floor</option>
                        @if (count($floors) > 0)
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->name }}">{{ $floor->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-input-error for="pickUpFloor" />
                </div>
            </div>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3">
                <div class="mb-5">
                    <label for="pickUpDateTime" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">
                        Pick-up Date
                    </label>
                    <input type="date" wire:model="pickUpDateTime" id="pickUpDateTime" placeholder="Select date"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300" />
                    <x-input-error for="pickUpDateTime" />
                </div>
            </div>
            <div class="w-full px-3 mb-3 sm:mb-0 sm:w-1/2">
                <label for="pickUpNeedExtraMan"
                    class="flex cursor-pointer justify-between gap-4 rounded-lg border border-gray-100 bg-white dark:bg-slate-800 p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 dark:border-gray-600 dark:hover:border-gray-700">
                    <div>
                        <p class="text-gray-700 dark:text-gray-200">Do you need extra man?</p>
                    </div>

                    <input type="checkbox" wire:model="pickUpNeedExtraMan" id="pickUpNeedExtraMan"
                        class="size-5 rounded dark:bg-slate-800 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                </label>
                <x-input-error for="pickUpNeedExtraMan" />
            </div>

            <div class="w-full px-3 sm:w-1/2">
                <label for="pickUpCanUseElevator"
                    class="flex cursor-pointer justify-between gap-4 rounded-lg border border-gray-100 bg-white dark:bg-slate-800 p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 dark:border-gray-600 dark:hover:border-gray-700">
                    <div>
                        <p class="text-gray-700 dark:text-gray-200">Is an elevator available?</p>
                    </div>

                    <input type="checkbox" wire:model="pickUpCanUseElevator" id="pickUpCanUseElevator"
                        class="size-5 rounded dark:bg-slate-800 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                </label>
                <x-input-error for="pickUpCanUseElevator" />
            </div>
        </div>
    </div>
    <div class="mb-5 pt-3">
        <label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl dark:text-white">
            Drop-off Address Details
        </label>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3">
                <div class="mb-5 relative">
                    <input type="text" wire:model="dropOffAddress" id="dropOffAddress" placeholder="Enter address"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300" />
                    <x-input-error for="dropOffAddress" />
                    @if (count($dropSuggestions) > 0)
                        <div id="dropSuggestionList"
                            class="absolute top-full z-10 bg-white dark:bg-gray-900 dark:text-gray-100 w-full border border-gray-300 mt-1 rounded-md shadow-md py-4">
                            @foreach ($dropSuggestions as $s => $suggest)
                                <button type="button" wire:click="setAddress('{{ $s }}','dropOffAddress')"
                                    class="block w-full py-1 px-4 text-start outline-none border-none hover:bg-gray-200 dark:hover:bg-gray-700">{{ $suggest['address'] }}</button>
                            @endforeach
                        </div>
                    @else
                        <div id="dropSuggestionList" class="hidden"></div>
                    @endif
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <input type="text" wire:model="dropOffPostCode" id="dropOffPostCode"
                        placeholder="Enter post code"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300" />
                    <x-input-error for="dropOffPostCode" />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <select wire:model="dropOffFloor"
                        id="dropOffFloor"class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-slate-800 dark:text-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:border-gray-600 dark:placeholder:text-gray-300">
                        <option value="">choose floor</option>
                        @if (count($floors) > 0)
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->name }}">{{ $floor->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <x-input-error for="dropOffFloor" />
            </div>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 mb-3 sm:mb-0 sm:w-1/2">
                <label for="dropOffNeedExtraMan"
                    class="flex cursor-pointer justify-between gap-4 rounded-lg border border-gray-100 bg-white dark:bg-slate-800 p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 dark:border-gray-600 dark:hover:border-gray-700">
                    <div>
                        <p class="text-gray-700 dark:text-gray-200">Do you need extra man?</p>
                    </div>

                    <input type="checkbox" wire:model="dropOffNeedExtraMan" id="dropOffNeedExtraMan"
                        class="size-5 rounded dark:bg-slate-800 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                </label>
                <x-input-error for="dropOffNeedExtraMan" />
            </div>

            <div class="w-full px-3 sm:w-1/2">
                <label for="dropOffCanUseElevator"
                    class="flex cursor-pointer justify-between gap-4 rounded-lg border border-gray-100 bg-white dark:bg-slate-800 p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 dark:border-gray-600 dark:hover:border-gray-700">
                    <div>
                        <p class="text-gray-700 dark:text-gray-200">Is an elevator available?</p>
                    </div>

                    <input type="checkbox" wire:model="dropOffCanUseElevator" id="dropOffCanUseElevator"
                        class="size-5 rounded dark:bg-slate-800 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                </label>
                <x-input-error for="dropOffCanUseElevator" />
            </div>
        </div>
    </div>
    <div class="flex justify-between items-center">
        <button wire:click="previousStep"
            class="inline-flex items-center outline-none border-none text-center font-semibold dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-arrow-narrow-left dark:text-white" width="40" height="40"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l4 4" />
                <path d="M5 12l4 -4" />
            </svg> Back
        </button>
        <button wire:click="submitStep2"
            class="hover:bg-orange-700 active:bg-orange-700 rounded-md bg-coral py-3 px-6 text-center text-base font-semibold text-white outline-none">
            next step
        </button>
    </div>
</div>
@push('scripts')
    <script>
        function getUserLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Call Livewire component with user's coordinates
                        Livewire.emit('setProximity', position.coords.latitude, position.coords
                            .longitude);                        
                    });
                }

                return;
        }
        window.addEventListener('DOMContentLoaded', () => {            
            getUserLocation();
        })


        flatpickr("#pickUpDateTime", {
            enableTime: false,
            altInput: true,
            altFormat: 'F j, Y',
            minDate: 'today',
            dateFormat: 'Y-m-d',
        });

        Livewire.on('invalidOperation', () => {
            toastr.error('Something\'s not right! Refresh page')
        })
    </script>
@endpush
