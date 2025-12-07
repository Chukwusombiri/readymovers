<x-admin-layout>
    <x-admin-nav page="Categories" />
    <div class="w-full px-6 py-6 mx-auto">        
        <!-- card 1 -->
        @livewire('admin.categories')
        {{-- footer --}}
        <x-admin-footer />
    </div>   
</x-admin-layout>
<script>
    Livewire.on('itemDeleted',e => {
        toastr.success('Successful Category deletion confirmed')
    })

    Livewire.on('deleteFailed',e => {
        toastr.error('Category deletion failed')
    })    
</script>