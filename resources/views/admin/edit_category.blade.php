<x-admin-layout>
    <x-admin-nav page="Category" />
    <div class="w-full max-w-full px-6 py-4">
        @livewire('admin.edit-category',['item' => $item]);
        {{-- footer --}}
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    Livewire.on('itemUpdated', e => {
        toastr.success('Category updated successfully')
    })

    Livewire.on('itemUpdateFailed', e => {
        toastr.error('Unable to update category')
    })
</script>