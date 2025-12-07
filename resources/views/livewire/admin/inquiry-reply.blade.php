<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3 md:w-7/12 mx-auto">
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            {{-- header --}}
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="text-3xl font-semibold">Prepare response to client inquiry</h6>
            </div>
            {{-- main --}}
            <div>
                <x-alert />
                <div class="w-full max-w-full px-3 shrink-0 mt-6">
                    <div class="mb-4">
                        <label for="recipient"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Recipient</label>
                            <input type="text" wire:model="recipient" readonly
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />                       
                        <x-input-error for="recipient" />
                    </div>
                </div> 
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="subject"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Subject</label>
                        <input type="text" wire:model="subject" placeholder="Enter email subject..."
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />                        
                        <x-input-error for="subject" />
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="body"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email message</label>
                           <textarea  wire:model="body"
                           id="body"
                           class="p-4 mt-2 w-full rounded-lg border-gray-200 align-top shadow-sm sm:text-sm"
                           rows="4"
                           placeholder="Enter email message..."
                           ></textarea>
                        <x-input-error for="body" />
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0 md:flex-0 flex justify-end my-10">
                    <button wire:click="sendEmail" type="button"
                        class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">send email</button>
                </div> 
            </div>
        </div>
    </div>
</div>