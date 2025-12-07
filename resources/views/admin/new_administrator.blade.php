<x-admin-layout>
    <x-admin-nav page="Administrator" />
    <div class="w-full px-6 py-6 mx-auto">        
        <!-- card 1 -->
        @livewire('admin.new-administrator',)
        {{-- footer --}}
        <x-admin-footer />
    </div>   
</x-admin-layout>