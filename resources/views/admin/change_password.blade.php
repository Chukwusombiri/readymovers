<x-admin-layout>
    <x-admin-nav page="Password" />
    <div class="w-full px-6 py-6 mx-auto">
        @livewire('admin.change-password')
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    Livewire.on('actionFailed',e =>{
        toastr.error('Oops! Something went wrong, contact site manager');
    })
</script>