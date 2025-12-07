<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3 md:w-7/12 mx-auto">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            {{-- header --}}
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="text-3xl font-semibold">Change account password</h6>
            </div>
            {{-- main --}}
            <div>
                <x-alert />
                <div class="w-full max-w-full px-3 shrink-0 mt-6">
                    <div class="mb-4">
                        <label for="currentPassword"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Current Password</label>
                        <input type="password" wire:model="currentPassword" id="currentPassword" placeholder="Enter your current password"
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        <x-input-error for="currentPassword" />
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="password"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">New Password</label>
                        <input type="password" wire:model="password" placeholder="Enter new password"
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        <x-input-error for="password" />
                    </div>
                </div>
                <div class="w-full max-w-full px-3 shrink-0">
                    <div class="mb-4">
                        <label for="password_confirmation"
                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Confirm Password</label>
                        <input type="password" wire:model="password_confirmation" placeholder="Repeat new password"
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        <x-input-error for="password_confirmation" />
                    </div>
                </div>
                <div class="px-4 text-sm font-medium text-rose-600">
                    NOTE: This action will logout all your other browser sessions except the current one
                </div>
                <div class="w-full max-w-full px-3 shrink-0 md:flex-0 flex justify-end my-10">
                    <button wire:click="submit" type="button"
                        class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">update password</button>
                </div>
            </div>
        </div>
    </div>
</div>