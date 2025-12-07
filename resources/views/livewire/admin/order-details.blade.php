<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 md:p-6 rounded-xl">
    <!-- Header with Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('orders') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Orders
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Order #{{ $order->order_refNo }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="mt-2 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Booking Details</h1>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $this->getOrderStatusColor($order->status) }}">
                    {{ ucfirst($order->status) }}
                </span>
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $this->getPaymentStatusColor($order->payment_status) }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Order Summary -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Information Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Booking Information</h2>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Created: {{ $order->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Information -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">User Details</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Username</label>
                                    <input type="text" wire:model.lazy="username"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="username" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Email Address</label>
                                    <input type="email" wire:model.lazy="email"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="email" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Phone Number</label>
                                    <input type="text" wire:model.lazy="phone"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="phone" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Booking Date & Time</label>
                                    <input type="datetime-local" wire:model.lazy="order_dateTime"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="order_dateTime" class="mt-1" />
                                </div>
                            </div>
                            
                            <button wire:click="saveUserDetails" type="button"
                                wire:loading.attr="disabled"
                                class="w-full py-2.5 px-4 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="saveUserDetails">Save User Details</span>
                                <span wire:loading wire:target="saveUserDetails" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Saving...
                                </span>
                            </button>
                        </div>

                        <!-- Items Information -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Items</h3>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ count($orderItems) }} items</span>
                            </div>
                            
                            <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                                @if(count($orderItems) > 0)
                                    @foreach($orderItems as $key => $item)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg group hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['name'] }}</p>
                                            </div>
                                            
                                            <div class="flex items-center space-x-3">
                                                @if($item['qty'] !== null)
                                                    <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                                        <button wire:click="reduceQty('{{ $key }}')"
                                                            class="px-3 py-1.5 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                                            {{ $item['qty'] == 1 ? 'disabled' : '' }}>
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                            </svg>
                                                        </button>
                                                        <span class="px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 min-w-[2rem] text-center">{{ $item['qty'] }}</span>
                                                        <button wire:click="incrementQty('{{ $key }}')"
                                                            class="px-3 py-1.5 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endif
                                                
                                                <button wire:click="removeItem('{{ $key }}')"
                                                    class="p-1.5 text-gray-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4">
                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No items added yet</p>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Add Item Form -->
                            <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Add Item</label>
                                        <select wire:model.lazy="selectedItem"
                                            class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                            <option value="">Choose item</option>
                                            @foreach($allItems as $element)
                                                <option value="{{ $element->id }}">{{ $element->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error for="selectedItem" class="mt-1" />
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Quantity</label>
                                        <input type="number" wire:model.lazy="selectedItemQty" min="1"
                                            class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                        <x-input-error for="selectedItemQty" class="mt-1" />
                                    </div>
                                </div>
                                
                                <button wire:click="saveOrderItems" type="button"
                                    wire:loading.attr="disabled"
                                    class="w-full py-2.5 px-4 bg-slate-500 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="saveOrderItems">Add Items</span>
                                    <span wire:loading wire:target="saveOrderItems" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Adding...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pick-up Information -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            Pick-up Details
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Address</label>
                                <input type="text" wire:model.lazy="pickUpAddress"
                                    class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                <x-input-error for="pickUpAddress" class="mt-1" />
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Postal Code</label>
                                    <input type="text" wire:model.lazy="pickUpPostCode"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="pickUpPostCode" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Floor</label>
                                    <select wire:model.lazy="pickUpFloor"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                        <option value="">Choose floor</option>
                                        @foreach($floors as $floor)
                                            <option value="{{ $floor->name }}" {{ $pickUpFloor === $floor->name ? 'selected' : '' }}>
                                                {{ $floor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="pickUpFloor" class="mt-1" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Expected Date/Time</label>
                                    <input type="datetime-local" wire:model.lazy="expectedPickUpDateTime"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="expectedPickUpDateTime" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Actual Date/Time</label>
                                    <input type="datetime-local" wire:model.lazy="actualPickUpDateTime"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="actualPickUpDateTime" class="mt-1" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                    <input type="checkbox" wire:model.lazy="pickUpNeedExtraMan" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Require Extra Man</span>
                                </label>
                                
                                <label class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                    <input type="checkbox" wire:model.lazy="pickUpCanUseElevator" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Can Use Elevator</span>
                                </label>
                            </div>
                        </div>
                        
                        <button wire:click="savePickUpDetails" type="button"
                            wire:loading.attr="disabled"
                            class="w-full py-2.5 px-4 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="savePickUpDetails">Save Pick-up Details</span>
                            <span wire:loading wire:target="savePickUpDetails" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            Delivery Details
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <!-- Same structure as Pick-up but with dropOff fields -->
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Address</label>
                                <input type="text" wire:model.lazy="dropOffAddress"
                                    class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                <x-input-error for="dropOffAddress" class="mt-1" />
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Postal Code</label>
                                    <input type="text" wire:model.lazy="dropOffPostCode"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="dropOffPostCode" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Floor</label>
                                    <select wire:model.lazy="dropOffFloor"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                        <option value="">Choose floor</option>
                                        @foreach($floors as $floor)
                                            <option value="{{ $floor->name }}" {{ $dropOffFloor === $floor->name ? 'selected' : '' }}>
                                                {{ $floor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="dropOffFloor" class="mt-1" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Expected Date/Time</label>
                                    <input type="datetime-local" wire:model.lazy="expectedDropOffDateTime"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="expectedDropOffDateTime" class="mt-1" />
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Actual Date/Time</label>
                                    <input type="datetime-local" wire:model.lazy="actualDropOffDateTime"
                                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <x-input-error for="actualDropOffDateTime" class="mt-1" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                    <input type="checkbox" wire:model.lazy="dropOffNeedExtraMan" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Require Extra Man</span>
                                </label>
                                
                                <label class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                    <input type="checkbox" wire:model.lazy="dropOffCanUseElevator" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Can Use Elevator</span>
                                </label>
                            </div>
                        </div>
                        
                        <button wire:click="saveDropOffDetails" type="button"
                            wire:loading.attr="disabled"
                            class="w-full py-2.5 px-4 bg-slate-500 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="saveDropOffDetails">Save Delivery Details</span>
                            <span wire:loading wire:target="saveDropOffDetails" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Order Summary & Actions -->
        <div class="space-y-6">
            <!-- Order Summary Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Booking Summary</h2>
                </div>
                
                <div class="p-6 space-y-4">
                    <!-- Status Controls -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Order Status</label>
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" @click.away="open = false" type="button"
                                    class="w-full flex items-center justify-between px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 rounded-full mr-2 {{ 
                                            $order->status === 'pending' ? 'bg-yellow-500' : 
                                            ($order->status === 'approved' ? 'bg-blue-500' : 
                                            ($order->status === 'dispatched' ? 'bg-indigo-500' : 
                                            ($order->status === 'delivered' ? 'bg-green-500' : 'bg-gray-500'))) 
                                        }}"></span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $order->status }}</span>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <div x-show="open" x-transition
                                    class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 overflow-hidden">
                                    <div class="py-1">
                                        @foreach(['pending', 'approved', 'dispatched', 'delivered'] as $status)
                                            <button wire:click="setStatus('{{ $status }}')" @click="open = false"
                                                class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 rounded-full mr-3 {{ 
                                                    $status === 'pending' ? 'bg-yellow-500' : 
                                                    ($status === 'approved' ? 'bg-blue-500' : 
                                                    ($status === 'dispatched' ? 'bg-indigo-500' : 'bg-green-500')) 
                                                }}"></span>
                                                <span class="capitalize">{{ $status }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Payment Status</label>
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" @click.away="open = false" type="button"
                                    class="w-full flex items-center justify-between px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 rounded-full mr-2 {{ 
                                            $order->payment_status === 'paid' ? 'bg-green-500' : 
                                            ($order->payment_status === 'unpaid' ? 'bg-red-500' : 
                                            ($order->payment_status === 'refunded' ? 'bg-gray-500' : 'bg-yellow-500')) 
                                        }}"></span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $order->payment_status }}</span>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <div x-show="open" x-transition
                                    class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 overflow-hidden">
                                    <div class="py-1">
                                        @foreach(['paid', 'unpaid', 'refunded'] as $paymentStatus)
                                            <button wire:click="setPaymentStatus('{{ $paymentStatus }}')" @click="open = false"
                                                class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 rounded-full mr-3 {{ 
                                                    $paymentStatus === 'paid' ? 'bg-green-500' : 
                                                    ($paymentStatus === 'unpaid' ? 'bg-red-500' : 'bg-gray-500') 
                                                }}"></span>
                                                <span class="capitalize">{{ $paymentStatus }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Financial Summary -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Financial Summary</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Quote Fee</span>
                                <div class="flex items-center">
                                    <input type="number" wire:model.lazy="quoteFee" step="0.01" min="0"
                                        class="w-32 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                    <span class="ml-2 text-sm font-medium">£</span>
                                </div>
                            </div>
                            <button wire:click="saveQuoteFee" type="button"
                                wire:loading.attr="disabled"
                                class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed text-sm">
                                Update Quote
                            </button>
                        </div>
                        
                        <div class="space-y-2 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Reservation Fee</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">£{{ number_format($order->upfront_fee ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Outstanding Amount</span>
                                <span class="text-sm font-semibold {{ $order->outstanding_fee > 0 ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-white' }}">
                                    £{{ number_format($order->outstanding_fee ?? 0, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Logistics Summary -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Logistics</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Distance</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $order->distance }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Duration</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $order->duration }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Timeline -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Timeline</h3>
                        <div class="space-y-3">
                            @php
                                $timelineEvents = [
                                    ['label' => 'Created', 'date' => $order->created_at, 'admin' => null, 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['label' => 'Approved', 'date' => $order->approved_at, 'admin' => $order->approvedByAdmin, 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['label' => 'Dispatched', 'date' => $order->dispatched_at, 'admin' => $order->dispatchedByAdmin, 'icon' => 'M9 17l2.5 2.5M14 14l2 2m4-4l2 2M3 3l18 18M3 7l2.5 2.5M3 11l2.5 2.5'],
                                    ['label' => 'Delivered', 'date' => $order->delivered_at, 'admin' => $order->deliveredByAdmin, 'icon' => 'M5 13l4 4L19 7'],
                                ];
                            @endphp
                            
                            @foreach($timelineEvents as $event)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $event['icon'] }}" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $event['label'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $event['date'] ? date('M d, y H:i:s', strtotime($event['date'])) : 'Not yet' }}
                                        </p>
                                        @if($event['admin'])
                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                By: {{ $event['admin']->name }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('orders') }}"
                            class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm font-medium text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to all jobs
                        </a>
                        
                        <button wire:click="sendOrderConfirmation"
                            class="w-full flex items-center justify-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-track {
        background: #374151;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-save functionality for form fields
    document.addEventListener('livewire:load', function () {
        // Debounce function to prevent excessive updates
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Listen for input changes and auto-save
        const inputs = document.querySelectorAll('input[wire\\:model], select[wire\\:model]');
        inputs.forEach(input => {
            input.addEventListener('input', debounce(function() {
                // Livewire will handle the auto-update due to wire:model.lazy
            }, 500));
        });
    });
</script>
@endpush