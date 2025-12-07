<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
    <div class="flex justify-between items-center flex-wrap p-6 pb-4 mb-0 border-b border-b-solid rounded-t-2xl border-b-gray-100">
        <h6 class="text-xl">Clients inquires</h6>

        <x-dropdown align='right'>
            <x-slot:trigger>
                <div class="inline-flex items-center overflow-hidden rounded-md border bg-white">
                    <a href="#"
                        class="border-e px-4 py-2 text-sm/none text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                        Filter
                    </a>

                    <button
                        class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                        <span class="sr-only">Menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </x-slot>

            <x-slot:content>
                <strong class="block p-2 text-xs font-medium uppercase text-gray-400"> General
                </strong>
                @foreach ($filters as $filter)
                    <button wire:click="applyFilter('{{ $filter }}')"
                        class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                        role="menuitem">
                        {{ $filter }}
                    </button>
                @endforeach
            </x-slot>
        </x-dropdown>
    </div>
    <x-validation-errors class="p-4"/>
    <div class="container px-5 py-8 mx-auto">
        @if ($inquiries !== null && count($inquiries) > 0)
            <div class="-my-8 divide-y divide-gray-200">
                @foreach ($inquiries as $inq)
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-6 mb-6 flex-shrink-0 flex flex-col">
                            <span class="font-semibold title-font text-gray-700"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                {{ $inq->username }}</span>
                            <span class="mt-1 text-gray-500 text-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                {{ $inq->email }}</span></span>
                            <span class="mt-1 text-gray-500 text-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                {{ $inq->phone }}</span></span>
                        </div>
                        <div class="md:flex-grow">
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $inq->subject }}</span>
                            </h2>
                            <p class="leading-relaxed">{{ $inq->inquiry }}</span></p>
                            <span class="text-sm font-light">{{ $inq->created_at->diffForHumans() }}</span>
                            <div class="flex justify-end items-center p-4">
                                <a href="{{ route('inquiries.reply', [$inq->email]) }}"
                                    class="text-gray-700 text-sm inline-flex items-center mt-4 mr-3">Reply
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                @if (!$inq->read_at)
                                    <button wire:click="markRead('{{ $inq->id }}')"
                                        class="text-sky-500 text-sm underline hover:no-underline inline-flex items-center mt-4 mr-3">Mark
                                        read</button>
                                @endif
                                <button wire:click="delete('{{ $inq->id }}')"
                                    class="text-rose-500 text-sm underline hover:no-underline inline-flex items-center mt-4">Delete</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="p-4">{{ $inquiries->links() }}</div>
            </div>
        @else
        <div class="max-w-3xl mx-auto text-3xl font-semibold text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-9 h-9">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
              </svg>
              No records
        </div>
        @endif
    </div>
</div>