<div class="flex flex-wrap -mx-3" x-data="{
    isOpen: false,
    orderIdToDelete: null,
    updateDeleteModalState(id) {
        this.orderIdToDelete = id;
        this.isOpen = true;
    }
}">
    <div class="flex-none w-full max-w-full px-3">
        <!-- Card Container -->
        <div
            class="relative mb-6 break-words bg-white dark:bg-slate-850 border-0 border-transparent border-solid shadow-xl dark:shadow-dark-xl rounded-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="p-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-1">
                            Moving Jobs Requests
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $orders->total() }} {{ Str::plural('request', $orders->total()) }}
                        </p>
                    </div>

                    <!-- Search Section -->
                    <div class="w-full sm:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.debounce.300ms="search"
                                placeholder="Search by reference, name, email or quote..."
                                class="pl-10 pr-10 py-2 w-full sm:w-80 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-colors"
                                aria-label="Search orders">
                            @if ($search)
                                <button wire:click="clear" type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
                                    aria-label="Clear search">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                        @if ($search)
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Showing results for: "{{ $search }}"
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Table Section -->
            <div class="p-0 overflow-hidden">
                @if (count($orders) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <!-- Column Headers -->
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <button wire:click="sortBy('order_refNo')"
                                            class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                            <span>Reference</span>
                                            @if ($sortField === 'order_refNo')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                </svg>
                                            @endif
                                        </button>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <button wire:click="sortBy('quote_fee')"
                                            class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                            <span>Quote</span>
                                            @if ($sortField === 'quote_fee')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                </svg>
                                            @endif
                                        </button>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <button wire:click="sortBy('upfront_fee')"
                                            class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                            <span>Reservation Fee</span>
                                            @if ($sortField === 'upfront_fee')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                </svg>
                                            @endif
                                        </button>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Payment
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <button wire:click="sortBy('order_dateTime')"
                                            class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                            <span>Created</span>
                                            @if ($sortField === 'order_dateTime')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    @if ($sortDirection === 'asc')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 15l7-7 7 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    @endif
                                                </svg>
                                            @endif
                                        </button>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                        <!-- Reference Number -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300 font-mono text-xs mr-3">
                                                    {{ substr($order->order_refNo, -4) }}
                                                </span>
                                                <code
                                                    class="font-mono text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $order->order_refNo }}
                                                </code>
                                            </div>
                                        </td>

                                        <!-- Client Info -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                    <span class="font-medium text-gray-700 dark:text-gray-300">
                                                        {{ substr($order->username, 0, 1) }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $order->username }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $order->email }}
                                                    </div>
                                                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                        {{ $order->phone }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Quote Amount -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                £{{ number_format($order->quote_fee ?? 0, 2) }}
                                            </div>
                                        </td>

                                        <!-- Reservation Fee -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                £{{ number_format($order->upfront_fee ?? 0, 2) }}
                                            </div>
                                        </td>

                                        <!-- Payment Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $color = $this->getPaymentStatusColor($order->payment_status);
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium capitalize {{ $color }}">
                                                {{ $order->payment_status }}
                                            </span>
                                        </td>

                                        <!-- Order Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $color = $this->getOrderStatusColor($order->status);
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium capitalize {{ $color }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <!-- Created Date -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                {{ date('M d, Y', strtotime($order->order_dateTime)) }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ date('H:i', strtotime($order->order_dateTime)) }}
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('order.edit', $order->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                                                    aria-label="View order {{ $order->order_refNo }}">
                                                    View
                                                </a>
                                                <button type="button"
                                                    x-on:click="updateDeleteModalState('{{ $order->id }}')"
                                                    x-bind:disabled="isOpen && orderIdToDelete === '{{ $order->id }}'"
                                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                                    class="inline-flex items-center px-3 py-1.5 border border-red-300 dark:border-red-700 text-xs font-medium rounded text-red-700 dark:text-red-400 bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                                    aria-label="Delete order">
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="py-16 text-center">
                        <div class="max-w-xs mx-auto">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                                No orders found
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                @if ($search)
                                    No orders match your search criteria.
                                @else
                                    Get started by creating your first order.
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Showing <span class="font-medium">{{ $orders->firstItem() }}</span> to
                            <span class="font-medium">{{ $orders->lastItem() }}</span> of
                            <span class="font-medium">{{ $orders->total() }}</span> results
                        </div>
                        <div class="flex items-center space-x-2">
                            {{ $orders->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div x-show="isOpen" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity"
                aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-on:click.away="isOpen = false"
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.196 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Delete Order
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Are you sure you want to delete order?
                                This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-3">
                    <button type="button"
                        x-on:click="$wire.delete(orderIdToDelete).then(() => { isOpen = false; orderIdToDelete = null; });"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-red-700 shadow-sm px-4 py-2 bg-gray-900 text-base font-medium text-red-700">
                        <span wire:loading.remove wire:target="delete">Delete</span>

                        <span wire:loading wire:target="delete">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" ...></svg>
                            Deleting...
                        </span>
                    </button>

                    <button type="button" x-on:click="isOpen = false; orderIdToDelete = null;"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
