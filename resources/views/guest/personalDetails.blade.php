<x-app-layout>    
    <section class="pt-16 pb-24 px-4 bg-gray-100 dark:bg-gray-800">
        <div class="flex items-center justify-center">
            <div class="mx-auto w-full max-w-[550px]">
                <div class="mb-6 space-y-2 bg-gray-100 dark:bg-transparent text-gray-800 dark:text-white">
                    <h3 class="text-2xl font-semibold">Step 3: Fill in your personal details</h3>
                    <div class="flex gap-3">
                        <span class="w-20 h-2 rounded-sm bg-emerald-500"></span>
                        <span class="w-20 h-2 rounded-sm bg-emerald-500"></span>
                        <span class="w-20 h-2 rounded-sm bg-slate-600"></span>
                    </div>
                </div>
    
                <div>
                    @livewire('personal-details')
                </div>
            </div>
        </div>
    </section>    
</x-app-layout>
<script>
    window.addEventListener('sentOrderMail', (e)=>{
        Swal.fire({
            icon:'success',
            title:'All done!',
            text: 'We\'ll get back to you shortly through email', 
        });
    }) 

    window.addEventListener('OrderMailFailed', (e)=>{
        Swal.fire({
            icon:'error',
            title:'Action failed!',
            text: 'Oops! Someting went wrong, try again.', 
        });
    }) 
</script>   