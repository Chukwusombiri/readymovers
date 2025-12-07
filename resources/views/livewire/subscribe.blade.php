<div class="flex flex-col items-center w-full mb-4 md:flex-row md:items-start md:px-16">
    <div class="flex-grow w-full mb-3 md:mr-2 md:mb-0">
        <input placeholder="Type your Email" required type="text" wire:model.lazy="email"
        class="w-full h-12 px-4 mb-3 text-gray-700 dark:text-gray-300 transition duration-200 border border-transparent rounded appearance-none focus:border-indigo-700 focus:outline-none focus:shadow-outline dark:bg-gray-800 dark:border-gray-600 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-900" />
        @error('email') <span class="block text-coral text-sm font-semibold">{{$message}}</span> @enderror
    </div>
    <x-secondary-button type="button" wire:click="submit"
        class="inline-flex items-center justify-center w-full h-12 px-6 font-semibold tracking-wide text-gray-200 transition duration-200 rounded shadow-md md:w-auto dark:text-gray-200 dark:hover:bg-indigo-600 dark:bg-gray-700 dark:hover:text-white">
        Subscribe
    </x-secondary-button>
</div>
