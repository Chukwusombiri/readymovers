<x-admin-layout>
    <x-admin-nav page="Administrator" />
    <div class="w-full px-6 py-6 mx-auto">        
        <!-- card 1 -->
        @livewire('admin.administrator-details',['sentAdmin'=>$admin])
        {{-- footer --}}
        <x-admin-footer />
    </div>   
</x-admin-layout>
<script>
    Livewire.on('savedLanguages', e => {
        toastr.success('Spoken languages saved successfully.');
    });
    Livewire.on('savedUserDetails', e => {
        toastr.success('Admin details successfully saved.');
    });
    Livewire.on('saveUserDetailFailed', e => {
        toastr.error('Oops!! Unable to save admin details');
    });

    Livewire.on('savedBioData', e => {
        toastr.success('Admin bio informations saved successfully');
    });

    Livewire.on('saveBioDataFailed', e => {
        toastr.error('Oops!! Unable to save admin details');
    });
</script>