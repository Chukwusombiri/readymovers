<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full flex justify-between items-center flex-wrap p-7">
        <h2 class="text-white">Transportation items</h2>
        <a class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85"
            href="{{ route('categories.create') }}">add new</a>
    </div>    
    @if (count($allItems) > 0)
        @foreach ($allItems as $t => $item)
            <!-- each item -->
            <div class="w-full max-w-full p-4 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/3">
                <div class="group relative block overflow-hidden">
                    {{-- @if ($item->photo_url)
                    <div class="h-64 sm:h-72 rounded-t-lg overflow-hidden">
                        <img src="{{ url('storage/' . $item->photo_url) }}" alt="Item {{ $t }} image"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                    </div>
                    @endif --}}
                    <div class="relative border border-gray-300 bg-white p-6 rounded-2xl">
                        <h3 class="mt-4 text-md font-bold text-gray-900 ">{{ $item->name }}</h3>
                        <p class="mt-1.5 text-sm text-gray-700">{{ $item->description }}</p>
                        <h6 class="mt-1.5 text-md text-gray-700">Price per unit: £{{ number_format($item->pricePerUnit) }}</h6>
                        <p class="text-sm font-light"><span class="font-bold">Countable:</span> {{ $item->isCountable ? 'Yes' : 'No' }}</p>
                        <p class="text-sm font-light mb-0"><span class="font-bold">Created at:</span> {{ date('M d, y', strtotime($item->created_at)) }}</p>
                        <p class="text-sm font-light"><span class="font-bold">Created by:</span> {{ $item->createdByAdmin()->name ?? 'Admin' }}</p>
                        <p class="text-sm font-light mb-0"><span class="font-bold">Last updated at:</span> {{ date('M d, y', strtotime($item->updated_at)) }}</p>
                        <p class="text-sm font-light"><span class="font-bold">last updated by:</span> {{ $item->updatedByAdmin()->name ?? 'Admin' }}</p>
                        <div class="flex items-center justify-center mt-4">
                            <a href="{{ route('categories.edit', [$item->id]) }}"
                                class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85 mr-4">
                                Edit
                            </a>
                            <button wire:click="deleteItem('{{ $item->id }}')"
                                class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-rose-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>            
        @endforeach
    @endif
</div>
