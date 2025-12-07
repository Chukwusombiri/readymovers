<x-app-layout>    
    <section class="pt-16 pb-24 px-4 bg-gray-100 dark:bg-gray-800">
        <div class="flex items-center justify-center">            
            <div class="mx-auto w-full max-w-[550px]">
                <div class="mb-6 space-y-2 bg-gray-100 dark:bg-transparent text-gray-800 dark:text-gray-200">
                    <h3 class="text-2xl font-semibold">Step 2: Enter your pick-up and drop-off details</h3>            
                    <div class="flex gap-3">                    
                        <span class="w-20 h-2 rounded-sm bg-emerald-500 dark:bg-emerald-400"></span>
                        <span class="w-20 h-2 rounded-sm bg-slate-800 dark:bg-slate-600"></span>
                        <span class="w-20 h-2 rounded-sm bg-gray-300 dark:bg-gray-600"></span>                                                                  
                    </div>
                </div>
                <x-validation-errors class="mb-4" />
                <div>                    
                    @livewire('delivery-details')                             
                </div>
            </div>
        </div>
    </section>    
</x-app-layout>