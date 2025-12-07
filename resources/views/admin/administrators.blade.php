<x-admin-layout>
    <x-admin-nav page="Administrators" />
    <div class="w-full px-6 py-6 mx-auto">
        <!-- card 1 -->
        @livewire('admin.administrators')
        {{-- footer --}}
        <x-admin-footer />
    </div>   
</x-admin-layout>
<script>
    Livewire.on('deletedAdmin',e => {
        toastr.success('Administrator record successfully deleted');
    })
</script>