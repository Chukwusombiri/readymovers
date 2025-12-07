<div>
    <div class="mb-5">
        <label for="name" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">
            Full Name
        </label>
        <input type="text" wire:model.lazy="username" id="name" placeholder="Full Name"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-900 dark:placeholder:text-gray-300" />       
        <x-input-error for="username" />
    </div>
    <div class="mb-5">
        <label for="phone" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">
            Phone Number
        </label>
        <input type="text" wire:model.lazy="phone" id="phone" placeholder="Enter your phone number"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-900 dark:placeholder:text-gray-300" />        
        <x-input-error for="phone" />
    </div>
    <div class="mb-5">
        <label for="email" class="mb-3 block text-base font-medium text-[#07074D] dark:text-white">
            Email Address
        </label>
        <input type="email" wire:model.lazy="email" id="email" placeholder="Enter your email"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:ring-offset-gray-900 dark:placeholder:text-gray-300" />        
        <x-input-error for="email" />
    </div>
    <div class="flex flex-wrap justify-around items-center mb-5">  
        @if ($isSubDomain)
        <button wire:click="instantQuote"
            class="flex shadow mb-3 sm:mb-0 text-sm hover:bg-orange-700 active:bg-orange-700 rounded-md bg-coral py-3 px-4 text-center text-base font-semibold text-gray-200 outline-none">
            Get instant quote 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-2 h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
              </svg>              
        </button>
        @else
        <button wire:click="submitStep3('whatsapp')"
            class="flex shadow mb-3 sm:mb-0 text-sm hover:bg-gray-50 active:bg-gray-100 rounded-md bg-white py-3 px-4 text-center text-base font-semibold text-emerald-500 outline-none dark:bg-gray-700 dark:text-emerald-400 dark:hover:bg-gray-700 dark:hover:text-white dark:hover:border-transparent">
            Get a quote on Whatsapp <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp ml-2 h-5 w-5 text-emerald-500 dark:text-emerald-300" viewBox="0 0 24 24" stroke-width="1.5" stroke="#10b981" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
            </svg>
        </button>
        <button wire:click="submitStep3('email')"
            class="flex shadow text-sm hover:bg-gray-100 active:bg-gray-100 rounded-md bg-white py-3 px-4 text-center text-base font-semibold text-blue-500 outline-none dark:bg-gray-700 dark:text-blue-400 dark:hover:bg-gray-700 dark:hover:text-white dark:hover:border-transparent">
            Get Quote through email <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail ml-2 h-5 w-5 text-emerald-500 dark:text-blue-300" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                <path d="M3 7l9 6l9 -6" />
            </svg>
        </button> 
        @endif              
    </div>
    <button wire:click="previousStep"
        class="inline-flex items-center outline-none border-none text-center font-semibold dark:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left dark:text-white" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l14 0" />
            <path d="M5 12l4 4" />
            <path d="M5 12l4 -4" />
          </svg> Back
    </button>    
</div>
@push('scripts')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Livewire.on('invalidOperation',()=>{        
        Toast.fire({
        icon: "error",
        title: "Something\'s not right! Refresh page"
        });
    }) 
</script>
@endpush
