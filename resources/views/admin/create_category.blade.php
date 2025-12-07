<x-admin-layout>
    <x-admin-nav page="Category" />
    <div class="w-full max-w-full px-6 py-4">
        @livewire('admin.create-category');
        {{-- footer --}}
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    Livewire.on('itemCreated', e => {
        toastr.success('Category created successfully')
    })

    Livewire.on('itemCreateFailed', e => {
        toastr.error('Unable to create category')
    })
</script>