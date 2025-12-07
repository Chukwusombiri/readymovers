<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3 md:w-7/12 mx-auto">
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            {{-- header --}}
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white text-3xl font-semibold">Prepare email to be sent</h6>
            </div>
            {{-- main --}}
            <div>
                <x-alert />
                <h2 class="text-xl font-semibold p-4 pb-0 mb-0">Recipients</h2>
                @error('recipients')
                    <div class="block w-full text-rose-600 p-2 text-sm font-semibold">{{ $message }}</div>
                @enderror
                @error('recipients.*')
                    <div class="block w-full text-rose-600 p-2 text-sm font-semibold">{{ $message }}</div>
                @enderror
                @if (count($recipients) > 0)
                    <div class="flex flex-wrap p-4">
                        @if (!$bulkEmail)
                            @foreach ($recipients as $r => $recipient)
                                <div class="inline-flex items-center overflow-hidden rounded-md border bg-white mr-1 mb-2">
                                    <span
                                        class="border-e px-4 py-2 text-sm/none text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                                        {{ $recipient }}
                                    </span>

                                    <button wire:click="removeRecipient({{ $r }})"
                                        class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                                        <span class="sr-only">remove recipient</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <span class="text-md text-semibold">Sending Email to every address in the mail list records...</span>
                        @endif
                    </div>
                @endif
                <div class="w-full max-w-full px-3 shrink-0 mt-6">
                    <div class="mb-4">
                        <label for="newRecipient"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Add
                           new recipient</label>
                        <div class="flex flex-nowrap mb-2">
                            <input type="text" id="newRecipient" wire:model="newRecipient"
                                placeholder="Enter recipient email (optional)"
                                class="w-7/12 px-4 py-2 rounded-l-lg focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease appearance-none border-solid border-gray-300 bg-white bg-clip-padding font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:ring-0 focus:outline-none">
                            <button type="button" wire:click='addRecipient'
                                class="px-7 py-2 rounded-r-lg font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 cursor-pointer text-xs bg-cyan-500 hover:shadow-xs active:opacity-85 dark:bg-slate-850 dark:text-white">
                                Add
                            </button>
                        </div>
                        @error('newRecipient')
                            <span class="block w-full text-rose-600 p-2 text-sm font-semibold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="subject"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Subject</label>
                        <input type="text" wire:model="subject" placeholder="Enter email subject..."
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        @error('subject')
                            <span class="block w-full text-rose-600 p-2 text-sm font-semibold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="body"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email message</label>
                           <textarea  wire:model="body"
                           id="body"
                           class="p-4 mt-2 w-full rounded-lg border-gray-200 align-top shadow-sm sm:text-sm dark:bg-slate-850 dark:text-white"
                           rows="4"
                           placeholder="Enter email message..."
                           ></textarea>
                        @error('body')
                            <span class="block w-full text-rose-600 p-2 text-sm font-semibold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0 md:flex-0 flex justify-end my-10">
                    <button wire:click="sendEmail" type="button"
                        class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85 dark:bg-slate-850 dark:text-white">send email</button>
                </div> 
            </div>
        </div>
    </div>
</div>