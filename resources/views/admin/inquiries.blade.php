<x-admin-layout>
    <x-admin-nav page="Inquiry" />
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                @livewire('admin.inquiries')
            </div>
        </div>
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    Livewire.on('failedAction', e => {
        toastr.error('Unable to perform action ' + e.details.action);
    })

    Livewire.on('deletedInquiry', e => {
        toastr.success('Deletion was successful');
    })
</script>
