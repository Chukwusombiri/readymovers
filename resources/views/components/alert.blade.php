<div>
    @if (session('success'))
        <div x-data="{ open: true }">
            <div x-show="open"
                class="bg-emerald-50 dark:bg-emerald-800 text-emerald-900 dark:text-emerald-200 font-semibold text-sm m-2 rounded p-4 flex justify-between">
                <span>{{ session('success') }}</span>
                <button @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ open: true }">
            <div x-show="open"
                class="bg-rose-50 dark:bg-rose-800 text-rose-900 dark:text-rose-200 font-semibold text-sm m-2 rounded p-4 flex justify-between">
                <span>{{ session('error') }}</span>
                <button @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>