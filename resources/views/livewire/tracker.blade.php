<div>
    <label
        class="mx-auto mt-8 relative bg-white dark:bg-gray-800 min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center py-2 px-2 rounded-2xl gap-2 shadow-2xl"
        for="search-bar">

        <input id="search-bar" placeholder="your order Reference number (RefNo)" wire:model="refNo"
            class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white dark:bg-gray-800 dark:text-gray-200" required>
        <button type="button" wire:click="submit"
            class="w-full md:w-auto px-6 py-3 bg-black dark:bg-gray-900 border-black text-white dark:text-gray-200 fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all">
            <div class="flex items-center transition-all opacity-1">
                <span class="text-sm font-semibold whitespace-nowrap truncate mx-auto">
                    Track now
                </span>
            </div>
        </button>
    </label>
</div>