<x-admin-layout>
    <x-admin-nav page="Email" />
    <div class="w-full px-6 py-6 mx-auto">
        @livewire('admin.send-email',['sentRecipients' => $sentRecipients])
        <x-admin-footer />
    </div>
</x-admin-layout>
<script>
    Livewire.on('actionFailed',e =>{
        toastr.error('Oops! Something went wrong, contact site manager');
    })
</script>