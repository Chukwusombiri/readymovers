import React, { useState, useEffect, useCallback, useMemo } from 'react';
import { 
  FaAngleDown, 
  FaArrowLeft, 
  FaSearch, 
  FaFilter,
  FaBox,
  FaTrash,
  FaPlus,
  FaMinus,
  FaCheckCircle
} from "react-icons/fa";
import { IoClose } from "react-icons/io5";
import { BiCollapseAlt } from "react-icons/bi";
import { motion, AnimatePresence } from 'framer-motion';
import PrimaryButton from './PrimaryButton';
import axios from 'axios';
import { toast } from 'react-toastify';

export default function QuoteItems({ allItems, next, prev }) {
    // Initialize from localStorage with proper parsing
    const [quoteItems, setQuoteItems] = useState(() => {
        try {
            const stored = localStorage.getItem('quoteItems');
            return stored ? JSON.parse(stored) : [];
        } catch (error) {
            console.error('Error parsing localStorage data:', error);
            return [];
        }
    });

    const [checkedIds, setCheckedIds] = useState(() => 
        quoteItems.map(item => item.id)
    );
    
    const [isOpen, setIsOpen] = useState(false);
    const [errors, setErrors] = useState(null);
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedCategory, setSelectedCategory] = useState('all');
    const [loading, setLoading] = useState(false);
    const [itemCount, setItemCount] = useState(0);

    // Extract unique categories
    const categories = useMemo(() => {
        const cats = ['all', ...new Set(allItems.map(item => item.category).filter(Boolean))];
        return cats;
    }, [allItems]);

    // Filter items based on search and category
    const filteredItems = useMemo(() => {
        return allItems.filter(item => {
            const matchesSearch = item.name.toLowerCase().includes(searchTerm.toLowerCase());
            const matchesCategory = selectedCategory === 'all' || item.category === selectedCategory;
            return matchesSearch && matchesCategory;
        });
    }, [allItems, searchTerm, selectedCategory]);

    // Update item count
    useEffect(() => {
        const total = quoteItems.reduce((sum, item) => sum + (item.qty || 1), 0);
        setItemCount(total);
    }, [quoteItems]);

    // Save to localStorage whenever quoteItems changes
    useEffect(() => {
        localStorage.setItem('quoteItems', JSON.stringify(quoteItems));
    }, [quoteItems]);

    // Handlers for item selection and quantity management
    const handleCheck = useCallback((id) => {
        setQuoteItems(prevItems => {
            if (checkedIds.includes(id)) {
                // Remove item
                const newItems = prevItems.filter(item => item.id !== id);
                setCheckedIds(prev => prev.filter(p => p !== id));
                return newItems;
            } else {
                // Add item
                const item = allItems.find(item => item.id === id);
                if (item) {
                    const newItem = {
                        id: item.id,
                        name: item.name,
                        category: item.category,
                        qty: item.isCountable ? 1 : null,
                        isCountable: item.isCountable
                    };
                    setCheckedIds(prev => [...prev, id]);
                    return [...prevItems, newItem];
                }
                return prevItems;
            }
        });
    }, [checkedIds, allItems]);

    const handleQuantityChange = useCallback((id, delta) => {
        setQuoteItems(prevItems =>
            prevItems.map(item => {
                if (item.id === id && item.isCountable) {
                    const newQty = Math.max(1, (item.qty || 1) + delta);
                    return { ...item, qty: newQty };
                }
                return item;
            })
        );
    }, []);

    const handleInputQuantityChange = useCallback((id, value) => {
        const numValue = parseInt(value, 10);
        if (isNaN(numValue) || numValue < 1) return;
        
        setQuoteItems(prevItems =>
            prevItems.map(item => {
                if (item.id === id && item.isCountable) {
                    return { ...item, qty: numValue };
                }
                return item;
            })
        );
    }, []);

    // handler for removing all items
    const handleRemoveAll = useCallback(() => {
        setQuoteItems([]);
        setCheckedIds([]);
        setIsOpen(false);
        toast.info('All items cleared');
    }, []);


    // Handle form submission to save items
    const handleSubmit = useCallback(async () => {
        if (quoteItems.length === 0) {
            toast.error('Please select at least one item');
            return;
        }

        // Validate all countable items have quantity >= 1
        const invalidItems = quoteItems.filter(item => 
            item.isCountable && (!item.qty || item.qty < 1)
        );
        
        if (invalidItems.length > 0) {
            toast.error('Please set valid quantities for all items');
            return;
        }

        setLoading(true);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            const response = await axios.post('/api/move/delivery-items', 
                { items: quoteItems },
                {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    credentials: 'include'
                }
            );

            if (response.data.success) {
                setErrors(null);
                toast.success('Items saved successfully!');
                next();
            }
        } catch (error) {
            if (error.response?.status === 422) {
                setErrors(error.response.data.errors);
                toast.error('Please check your item selections');
            } else if (error.response?.status === 401) {
                toast.error('Please log in to continue');
            } else {
                console.error('Unexpected error:', error);
                toast.error('Something went wrong. Please try again.');
            }
        } finally {
            setLoading(false);
        }
    }, [quoteItems, next]);

    // Handle go back action
    const handleGoBack = useCallback(() => {
        if (quoteItems.length > 0) {
            localStorage.setItem('quoteItems', JSON.stringify(quoteItems));
        }
        prev();
    }, [quoteItems, prev]);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 0.5 }}
            className="max-w-6xl mx-auto"
        >
            {/* Header */}
            <div className="text-center mb-8">
                <motion.h2 
                    initial={{ y: -20, opacity: 0 }}
                    animate={{ y: 0, opacity: 1 }}
                    className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3"
                >
                    Select Your Items
                </motion.h2>
                <p className="text-gray-600 dark:text-gray-300 mb-6">
                    Choose the furniture and items you need to move
                </p>
            </div>

            {/* Quick Stats */}
            <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div className="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                    <div className="flex items-center gap-3">
                        <div className="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                            <FaBox className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Selected Items</p>
                            <p className="text-2xl font-bold text-gray-900 dark:text-white">{quoteItems.length}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl border border-green-100 dark:border-green-800">
                    <div className="flex items-center gap-3">
                        <div className="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                            <FaBox className="w-5 h-5 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Total Pieces</p>
                            <p className="text-2xl font-bold text-gray-900 dark:text-white">{itemCount}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-xl border border-purple-100 dark:border-purple-800">
                    <div className="flex items-center gap-3">
                        <div className="p-2 bg-purple-100 dark:bg-purple-800 rounded-lg">
                            <FaCheckCircle className="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Categories</p>
                            <p className="text-2xl font-bold text-gray-900 dark:text-white">{categories.length - 1}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-amber-50 dark:bg-amber-900/20 p-4 rounded-xl border border-amber-100 dark:border-amber-800">
                    <div className="flex items-center gap-3">
                        <div className="p-2 bg-amber-100 dark:bg-amber-800 rounded-lg">
                            <FaFilter className="w-5 h-5 text-amber-600 dark:text-amber-400" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Available</p>
                            <p className="text-2xl font-bold text-gray-900 dark:text-white">{allItems.length}</p>
                        </div>
                    </div>
                </div>
            </div>

            {/* Item Selection Card */}
            <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8">
                {/* Selection Header */}
                <motion.button
                    onClick={() => setIsOpen(!isOpen)}
                    whileHover={{ scale: 1.01 }}
                    whileTap={{ scale: 0.99 }}
                    className="w-full p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-900"
                >
                    <div className="flex items-center gap-4">
                        <div className={`p-3 rounded-full ${isOpen ? 'bg-blue-100 dark:bg-blue-900' : 'bg-gray-100 dark:bg-gray-700'}`}>
                            <FaBox className={`w-6 h-6 ${isOpen ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400'}`} />
                        </div>
                        <div className="text-left">
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white">
                                Item Selection
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Click to {isOpen ? 'close' : 'open'} item picker
                            </p>
                        </div>
                    </div>
                    <motion.div
                        animate={{ rotate: isOpen ? 180 : 0 }}
                        transition={{ duration: 0.3 }}
                    >
                        <FaAngleDown className="w-6 h-6 text-gray-600 dark:text-gray-400" />
                    </motion.div>
                </motion.button>

                {/* Item Picker Panel */}
                <AnimatePresence>
                    {isOpen && (
                        <motion.div
                            initial={{ height: 0, opacity: 0 }}
                            animate={{ height: 'auto', opacity: 1 }}
                            exit={{ height: 0, opacity: 0 }}
                            transition={{ duration: 0.3 }}
                            className="overflow-hidden"
                        >
                            <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                                {/* Search and Filter */}
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div className="relative">
                                        <FaSearch className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                                        <input
                                            type="text"
                                            placeholder="Search items..."
                                            value={searchTerm}
                                            onChange={(e) => setSearchTerm(e.target.value)}
                                            className="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent"
                                        />
                                    </div>
                                    <div className="relative">
                                        <FaFilter className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                                        <select
                                            value={selectedCategory}
                                            onChange={(e) => setSelectedCategory(e.target.value)}
                                            className="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent appearance-none"
                                        >
                                            {categories.map(category => (
                                                <option key={category} value={category}>
                                                    {category === 'all' ? 'All Categories' : category}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                </div>

                                {/* Items Grid */}
                                <div className="max-h-[400px] overflow-y-auto pr-2">
                                    {filteredItems.length === 0 ? (
                                        <div className="text-center py-8">
                                            <FaBox className="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" />
                                            <p className="text-gray-500 dark:text-gray-400">
                                                No items found. Try a different search term or category.
                                            </p>
                                        </div>
                                    ) : (
                                        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                            {filteredItems.map(item => (
                                                <motion.div
                                                    key={item.id}
                                                    whileHover={{ scale: 1.02 }}
                                                    whileTap={{ scale: 0.98 }}
                                                    onClick={() => handleCheck(item.id)}
                                                    className={`cursor-pointer p-4 rounded-xl border-2 transition-all duration-200 ${
                                                        checkedIds.includes(item.id)
                                                            ? 'border-blue-500 dark:border-blue-400 bg-blue-50 dark:bg-blue-900/30'
                                                            : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                                                    }`}
                                                >
                                                    <div className="flex items-start gap-3">
                                                        <div className={`p-2 rounded-lg ${
                                                            checkedIds.includes(item.id)
                                                                ? 'bg-blue-100 dark:bg-blue-800'
                                                                : 'bg-gray-100 dark:bg-gray-700'
                                                        }`}>
                                                            <FaBox className={`w-5 h-5 ${
                                                                checkedIds.includes(item.id)
                                                                    ? 'text-blue-600 dark:text-blue-400'
                                                                    : 'text-gray-600 dark:text-gray-400'
                                                            }`} />
                                                        </div>
                                                        <div className="flex-1">
                                                            <h4 className={`font-medium ${
                                                                checkedIds.includes(item.id)
                                                                    ? 'text-blue-700 dark:text-blue-300'
                                                                    : 'text-gray-900 dark:text-white'
                                                            }`}>
                                                                {item.name}
                                                            </h4>
                                                            {item.category && (
                                                                <span className="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full mt-1 inline-block">
                                                                    {item.category}
                                                                </span>
                                                            )}
                                                        </div>
                                                        <div className={`w-5 h-5 rounded-full border-2 flex items-center justify-center ${
                                                            checkedIds.includes(item.id)
                                                                ? 'border-blue-500 bg-blue-500'
                                                                : 'border-gray-300 dark:border-gray-600'
                                                        }`}>
                                                            {checkedIds.includes(item.id) && (
                                                                <div className="w-2 h-2 rounded-full bg-white"></div>
                                                            )}
                                                        </div>
                                                    </div>
                                                </motion.div>
                                            ))}
                                        </div>
                                    )}
                                </div>

                                {/* Panel Footer */}
                                <div className="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                    <button
                                        onClick={handleRemoveAll}
                                        className="flex items-center gap-2 px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                    >
                                        <FaTrash className="w-4 h-4" />
                                        Clear All
                                    </button>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">
                                        Showing {filteredItems.length} of {allItems.length} items
                                    </div>
                                </div>
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>

                {/* Selected Items Table */}
                <div className="p-6">
                    <div className="flex justify-between items-center mb-6">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">
                            Selected Items ({quoteItems.length})
                        </h3>
                        {quoteItems.length > 0 && (
                            <button
                                onClick={handleRemoveAll}
                                className="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 flex items-center gap-2"
                            >
                                <FaTrash className="w-4 h-4" />
                                Remove All
                            </button>
                        )}
                    </div>

                    {quoteItems.length === 0 ? (
                        <div className="text-center py-8">
                            <FaBox className="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" />
                            <p className="text-gray-500 dark:text-gray-400 mb-4">
                                No items selected yet. Choose items from the picker above.
                            </p>
                        </div>
                    ) : (
                        <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                            <table className="w-full">
                                <thead className="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th className="py-3 px-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                            Item
                                        </th>
                                        <th className="py-3 px-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                            Quantity
                                        </th>
                                        <th className="py-3 px-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                            Category
                                        </th>
                                        <th className="py-3 px-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 dark:divide-gray-700">
                                    {quoteItems.map(item => (
                                        <motion.tr
                                            key={item.id}
                                            initial={{ opacity: 0, y: 10 }}
                                            animate={{ opacity: 1, y: 0 }}
                                            className="hover:bg-gray-50 dark:hover:bg-gray-800/50"
                                        >
                                            <td className="py-4 px-4">
                                                <div className="flex items-center gap-3">
                                                    <div className="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                                        <FaBox className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                                    </div>
                                                    <span className="font-medium text-gray-900 dark:text-white">
                                                        {item.name}
                                                    </span>
                                                </div>
                                            </td>
                                            <td className="py-4 px-4">
                                                {item.isCountable ? (
                                                    <div className="flex items-center gap-2">
                                                        <button
                                                            onClick={() => handleQuantityChange(item.id, -1)}
                                                            className="p-1 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600"
                                                        >
                                                            <FaMinus className="w-3 h-3" />
                                                        </button>
                                                        <input
                                                            type="number"
                                                            min="1"
                                                            value={item.qty || 1}
                                                            onChange={(e) => handleInputQuantityChange(item.id, e.target.value)}
                                                            className="w-20 text-center py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent"
                                                        />
                                                        <button
                                                            onClick={() => handleQuantityChange(item.id, 1)}
                                                            className="p-1 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600"
                                                        >
                                                            <FaPlus className="w-3 h-3" />
                                                        </button>
                                                    </div>
                                                ) : (
                                                    <span className="text-gray-500 dark:text-gray-400">N/A</span>
                                                )}
                                            </td>
                                            <td className="py-4 px-4">
                                                {item.category ? (
                                                    <span className="px-3 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                        {item.category}
                                                    </span>
                                                ) : (
                                                    <span className="text-gray-400">—</span>
                                                )}
                                            </td>
                                            <td className="py-4 px-4">
                                                <button
                                                    onClick={() => handleCheck(item.id)}
                                                    className="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                                >
                                                    <IoClose className="w-5 h-5" />
                                                </button>
                                            </td>
                                        </motion.tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            </div>

            {/* Error Messages */}
            {errors && (
                <motion.div
                    initial={{ opacity: 0, y: -10 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl"
                >
                    <h4 className="font-semibold text-red-700 dark:text-red-400 mb-2">
                        Please fix the following errors:
                    </h4>
                    <ul className="list-disc list-inside space-y-1">
                        {Object.values(errors).flat().map((error, idx) => (
                            <li key={idx} className="text-sm text-red-600 dark:text-red-400">
                                {error}
                            </li>
                        ))}
                    </ul>
                </motion.div>
            )}

            {/* Action Buttons */}
            <div className="flex flex-col md:flex-row gap-4 justify-between items-center mt-8">
                <button
                    onClick={handleGoBack}
                    className="flex items-center gap-3 px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                    <FaArrowLeft className="w-5 h-5" />
                    <span className="font-medium">Go Back</span>
                </button>

                <div className="flex flex-col md:flex-row items-center gap-4">
                    {quoteItems.length > 0 && (
                        <div className="text-sm text-gray-600 dark:text-gray-400 text-center">
                            <span className="font-semibold">{quoteItems.length} items</span> selected • 
                            <span className="font-semibold ml-2">{itemCount} pieces</span>
                        </div>
                    )}
                    
                    <PrimaryButton
                        onClick={handleSubmit}
                        disabled={quoteItems.length === 0 || loading}
                        className="min-w-[200px] py-3 px-8 text-lg font-medium transition-all duration-300 hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                    >
                        {loading ? (
                            <span className="flex items-center justify-center gap-2">
                                <div className="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                Saving...
                            </span>
                        ) : (
                            <span className="flex items-center justify-center gap-2">
                                Continue to Next Step
                                <FaArrowLeft className="w-5 h-5 transform rotate-180" />
                            </span>
                        )}
                    </PrimaryButton>
                </div>
            </div>
        </motion.div>
    );
}