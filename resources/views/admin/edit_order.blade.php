<x-admin-layout>
    <x-admin-nav page="Order" />
    <div class="w-full px-6 py-6 mx-auto">        
        <!-- card 1 -->
        @livewire('admin.order-details',['order' => $order])
        {{-- footer --}}
        <x-admin-footer />
    </div>   
</x-admin-layout>
<script>
    Livewire.on('statusUpdated',e => {
        toastr.success('Order status updated successfully')
    })

    Livewire.on('statusUpdateFailed',e => {
        toastr.error('Order status update failed')
    })

    Livewire.on('somethingWrong',e => {
        toastr.error('Oops! Something went wrong')
    })

    Livewire.on('updatedQuote',e => {
        toastr.success('Quote fee successfully updated')
    })

    Livewire.on('userDetailsSaved',e => {
        toastr.success('User details successfully updated')
    })

    Livewire.on('savedOrderItems',e => {
        toastr.success('Order items successfully updated')
    })

    Livewire.on('savedPickUpDetails',e => {
        toastr.success('Pick-up details successfully updated')
    })

    Livewire.on('savedDropOffDetails',e => {
        toastr.success('Pick-up details successfully updated')
    })
</script>