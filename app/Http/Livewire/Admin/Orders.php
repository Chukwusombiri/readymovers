<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    
    public $search = '';
    public $sortField = 'order_dateTime'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction
    public $confirmingDeleteId = null; // For delete confirmation modal
    
    // Protected properties for pagination
    protected $paginationTheme = 'tailwind';
    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'order_dateTime'],
        'sortDirection' => ['except' => 'desc'],
    ];

    /**
     * Reset pagination when search is updated
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Clear search and reset pagination
     */
    public function clear()
    {
        $this->search = '';
        $this->resetPage();
    }

    /**
     * Sort by specified field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // If already sorting by this field, toggle direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Sort by new field, default to ascending
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Show delete confirmation modal
     */
    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    /**
     * Cancel delete confirmation
     */
    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    /**
     * Delete order after confirmation
     */
    public function delete($id = null)
    {
        // Use either the confirmation ID or passed ID
        $orderId = $id ?? $this->confirmingDeleteId;
        
        if (!$orderId) {
            return;
        }

        try {
            $order = Order::findOrFail($orderId);
            $order->delete();
            
            $this->confirmingDeleteId = null;
            
            // Emit success event
            $this->emit('orderDeleted', [
                'message' => 'Order deleted successfully.',
                'refNo' => $order->order_refNo
            ]);
            
        } catch (\Exception $e) {
            $this->confirmingDeleteId = null;
            
            // Emit error event
            $this->emit('failedDeletion', [
                'message' => 'Failed to delete order. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Apply search filter to query
     */
    private function applySearchFilter($query)
    {
        if (!$this->search) {
            return $query;
        }

        $searchTerm = '%' . $this->search . '%';
        
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('order_refNo', 'like', $searchTerm)
              ->orWhere('username', 'like', $searchTerm)
              ->orWhere('email', 'like', $searchTerm)
              ->orWhere('phone', 'like', $searchTerm)
              ->orWhere('quote_fee', 'like', $searchTerm)
              ->orWhere('upfront_fee', 'like', $searchTerm)
              ->orWhere('status', 'like', $searchTerm)
              ->orWhere('payment_status', 'like', $searchTerm);
        });
    }

    /**
     * Apply sorting to query
     */
    private function applySorting($query)
    {
        $allowedFields = [
            'order_refNo',
            'username', 
            'email',
            'quote_fee',
            'upfront_fee',
            'payment_status',
            'status',
            'order_dateTime',
            'created_at'
        ];

        if (in_array($this->sortField, $allowedFields)) {
            return $query->orderBy($this->sortField, $this->sortDirection);
        }

        // Default sorting
        return $query->orderBy('order_dateTime', 'desc');
    }

    /**
     * Get the formatted payment status color
     */
    public function getPaymentStatusColor($status)
    {
        $colors = [
            'paid' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'refunded' => 'bg-neutral-100 dark:bg-neutral-900/30 text-neutral-800 dark:text-neutral-300',
            'pending' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300',
            'failed' => 'bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-300'
        ];

        return $colors[$status] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300';
    }

    /**
     * Get the formatted order status color
     */
    public function getOrderStatusColor($status)
    {
        $colors = [
            'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300',
            'approved' => 'bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-300',
            'dispatched' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300',
            'delivered' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'cancelled' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
        ];

        return $colors[$status] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300';
    }

    /**
     * Render the component view
     */
    public function render()
    {
        // Start building the query
        $query = Order::query();
        
        // Apply search filter
        $query = $this->applySearchFilter($query);
        
        // Apply sorting
        $query = $this->applySorting($query);
        
        // Paginate results
        $orders = $query->paginate(10); 

        return view('livewire.admin.orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Get the searching state (for loading indicator)
     */
    public function getSearchingProperty()
    {
        return $this->search !== '';
    }

    /**
     * Reset sorting and filters
     */
    public function resetFilters()
    {
        $this->reset(['search', 'sortField', 'sortDirection']);
        $this->resetPage();
    }
}