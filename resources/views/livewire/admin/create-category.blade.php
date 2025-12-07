<div class="flex flex-wrap justify-center -mx-3 mt-6">
    <div class="w-full max-w-full px-3 md:w-9/12">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-6">
                <div class="flex justify-between items-start flex-wrap">
                    <p class="uppercase text-sm">Create new category</p>
                    <a href="{{route('categories')}}" class="flex items-center gap-2 flex-nowrap text-xs uppercase text-coral font-semibold hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>                          
                        back
                    </a>
                </div>
                <div class="flex flex-wrap items-start -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="name"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Name</label>
                            <input type="text" wire:model="name" id="name"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />                            
                            <x-input-error for="name" />                            
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="pricePerUnit"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Price per unit</label>
                            <input type="nujmber" step="0.01" wire:model="pricePerUnit" id="pricePerUnit"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />                            
                            <x-input-error for="pricePerUnit" />                            
                        </div>
                    </div>
                    
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="description"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Description</label>
                            <textarea type="text" wire:model="description" id="description" rows="6"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></textarea>                            
                            <x-input-error for="description" />
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <span
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Countable</span>
                            <label for="isCountable" class="flex cursor-pointer items-start gap-4 rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center">
                                    &#8203;
                                    <input type="checkbox" class="size-5 rounded border-gray-300"  wire:model="isCountable" id="isCountable" />
                                </div>

                                <div>
                                    <strong class="font-medium text-gray-900"> would you want category to be countable? </strong>
                                </div>
                            </label>
                            <x-input-error for="isCountable" />
                        </div>
                    </div>
                    {{-- <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                        <div class="w-full my-6">
                            @if ($photo)
                                Photo Preview:
                                <img src="{{ $photo->temporaryUrl() }}" alt="new photo preview" class="block w-56 h-56 rounded-xs shadow">                            
                            @endif
                        </div>
                        <div class="relative w-full mt-4">
                            <div class="items-center justify-center max-w-xl mx-auto">
                                <p class="text-sm font-bold text-gray-900">Add picture</p>
                                <label for="photo"
                                    class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                    <span class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <span class="font-medium text-gray-600">Drop files to Attach, or<span
                                                class="text-blue-600 underline ml-[4px]">browse</span></span>
                                    </span>
                                    <input type="file" wire:model="photo" id="photo" class="hidden"
                                        accept="image/png,image/jpeg" />
                                </label>
                            </div>
                        </div>
                        <x-input-error for="photo" />
                    </div> --}}

                    <div class="w-full mt-4 flex justify-end pt-4">
                        <button wire:click="save" type="button"
                            class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>