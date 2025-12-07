<x-admin-layout>
    <x-admin-nav page="Booking Management" />    
    <div class="w-full px-6 py-6 mx-auto">        
        <!-- table 1 -->
        @livewire('admin.orders')
        {{-- footer --}}
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('orderDeleted', function() {
            toastr.success('Successful! Order record was deleted');
        });

        Livewire.on('failedDeletion', function() {
            toastr.success('Oops! Unable to perform action, refresh page and try again.');
        });     
});
</script>   
