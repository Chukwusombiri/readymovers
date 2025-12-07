import React, { useEffect, useState, useCallback } from 'react';
import {
    FaArrowLeft,
    FaWhatsapp,
    FaCreditCard,
    FaMapMarkerAlt,
    FaBoxOpen,
    FaCalendarAlt,
    FaMoneyBillWave,
    FaCheckCircle,
    FaUser,
    FaPhone,
    FaEnvelope,
    FaShieldAlt
} from 'react-icons/fa';
import { motion, AnimatePresence } from 'framer-motion';
import { BounceLoader } from 'react-spinners';
import { toast } from 'react-toastify';
import axios from 'axios';
import { Link } from '@inertiajs/react';
import PrimaryButton from './PrimaryButton';
import { PiWarning } from "react-icons/pi";

function Summary({ reset, prev, restart }) {
    const [isLoading, setIsLoading] = useState(true);
    const [summary, setSummary] = useState(null);
    const [fetchError, setFetchError] = useState(null);
    const [selectedOption, setSelectedOption] = useState(null);
    const [processingPayment, setProcessingPayment] = useState(false);

    // Fetch summary data from server handler
    const fetchSummary = useCallback(async (signal) => {
        setIsLoading(true);
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const resp = await axios.get('/api/move/fetchSummary', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                signal
            });

            if (resp.status === 200 && resp.data) {
                setSummary(resp.data.data || resp.data);
                setFetchError(null);
            } else {
                throw new Error('Invalid response format');
            }
        } catch (error) {
            if (axios.isCancel(error)) {
                console.log('Request canceled:', error.message);
                return;
            }

            if (error.response) {
                if (error.response.status === 400 && error.response.data?.restart) {
                    toast.info('Session expired or incomplete data. Starting fresh...');
                    setTimeout(() => restart(), 1500);
                    return;
                }
                setFetchError(error.response.data?.message || 'Failed to fetch summary');
            } else if (error.request) {
                setFetchError('Network error. Please check your connection.');
            } else {
                setFetchError(error.message || 'An unexpected error occurred');
            }
        } finally {
            setIsLoading(false);
        }
    }, [restart]);

    // Fetch summary on component mount
    useEffect(() => {
        const controller = new AbortController();
        fetchSummary(controller.signal);

        return () => {
            controller.abort();
        };
    }, [fetchSummary]);

    // Handle submission for checkout or WhatsApp
    const handleSubmit = useCallback(async (source) => {
        if (processingPayment) return;

        setProcessingPayment(true);
        setSelectedOption(source);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const response = await axios.post('/api/move/checkout',
                { source },
                {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                }
            );

            if (response.status === 200 && response.data.redirect) {
                toast.success('Processing your request...');

                // Handle redirect
                if (response.data.redirect && typeof response.data.redirect === 'string') {
                    // Clear localStorage
                    localStorage.removeItem('deliveryDetails');
                    localStorage.removeItem('quoteItems');
                    localStorage.removeItem('userInfo');
                    setTimeout(() => {
                        window.location.href = response.data.redirect;
                    }, 1000);
                } else {
                    throw new Error('No redirect URL provided');
                }
            } else {
                throw new Error(response.data.message || 'Payment processing failed');
            }
        } catch (error) {
            console.error('Checkout error:', error);

            if (error.response?.data?.message) {
                toast.error(error.response.data.message);
            } else if (error.response?.status === 422) {
                toast.error('Please complete all required information.');
            } else if (error.response?.status === 401) {
                toast.error('Session expired. Please refresh the page.');
            } else {
                toast.error(error.message || 'Something went wrong. Please try again.');
            }
        } finally {
            setProcessingPayment(false);
            setSelectedOption(null);
        }
    }, [processingPayment]);

    const formatCurrency = useCallback((amount) => {
        return new Intl.NumberFormat('en-GB', {
            style: 'currency',
            currency: 'GBP',
            minimumFractionDigits: 2
        }).format(amount || 0);
    }, []);

    const handleReset = useCallback(() => {
        reset();
        toast.info('Starting a new quote...');
    }, [reset]);

    const handleGoBack = useCallback(() => {
        prev();
    }, [prev]);

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
                    transition={{ delay: 0.2 }}
                    className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3"
                >
                    Your Moving Quote Summary
                </motion.h2>
                <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Review your details and choose how you'd like to proceed
                </p>
            </div>

            {/* Loading State */}
            <AnimatePresence>
                {isLoading && (
                    <motion.div
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        exit={{ opacity: 0 }}
                        className="h-[60vh] flex flex-col items-center justify-center"
                    >
                        <BounceLoader
                            color="#4f46e5"
                            size={60}
                            className="mb-6"
                        />
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Preparing Your Quote
                        </h3>
                        <p className="text-gray-600 dark:text-gray-300">
                            Please wait while we calculate your moving costs...
                        </p>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Error State */}
            <AnimatePresence>
                {!isLoading && fetchError && (
                    <motion.div
                        initial={{ opacity: 0, scale: 0.9 }}
                        animate={{ opacity: 1, scale: 1 }}
                        exit={{ opacity: 0 }}
                        className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 max-w-xl mx-auto text-center"
                    >
                        <div className="flex flex-col items-center">
                            <div className="p-4 bg-red-100 dark:bg-red-900/30 rounded-full mb-6">
                                <PiWarning className="w-16 h-16 text-red-600 dark:text-red-400" />
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                                Oops! Something Went Wrong
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 mb-6">
                                {fetchError}
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4">
                                <button
                                    onClick={handleReset}
                                    className="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 dark:bg-blue-600 dark:hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                                >
                                    Start New Quote
                                </button>
                                <button
                                    onClick={() => window.location.reload()}
                                    className="px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg font-medium transition-colors"
                                >
                                    Refresh Page
                                </button>
                            </div>
                        </div>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Success State */}
            <AnimatePresence>
                {!isLoading && !fetchError && summary && (
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.3 }}
                        className="space-y-8"
                    >
                        {/* Summary Cards */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {/* Pick-up Details */}
                            <motion.div
                                whileHover={{ scale: 1.02 }}
                                className="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 rounded-2xl p-6 border border-blue-200 dark:border-blue-800"
                            >
                                <div className="flex items-center gap-4 mb-4">
                                    <div className="p-3 bg-blue-100 dark:bg-blue-800 rounded-xl">
                                        <FaMapMarkerAlt className="w-6 h-6 text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <div>
                                        <h3 className="text-lg font-bold text-gray-900 dark:text-white">Pick-up Location</h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Moving from</p>
                                    </div>
                                </div>
                                <div className="space-y-3">
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Address</p>
                                        <p className="font-medium text-gray-900 dark:text-white">{summary.pickUpAddress}</p>
                                    </div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Floor</p>
                                        <p className="font-medium text-gray-900 dark:text-white">{summary.pickUpFloor}</p>
                                    </div>
                                    {summary.elevatorAtPickUp && (
                                        <div className="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-300 rounded-full text-sm">
                                            <FaCheckCircle className="w-4 h-4" />
                                            Elevator available
                                        </div>
                                    )}
                                </div>
                            </motion.div>

                            {/* Delivery Details */}
                            <motion.div
                                whileHover={{ scale: 1.02 }}
                                className="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-900/10 rounded-2xl p-6 border border-green-200 dark:border-green-800"
                            >
                                <div className="flex items-center gap-4 mb-4">
                                    <div className="p-3 bg-green-100 dark:bg-green-800 rounded-xl">
                                        <FaMapMarkerAlt className="w-6 h-6 text-green-600 dark:text-green-400" />
                                    </div>
                                    <div>
                                        <h3 className="text-lg font-bold text-gray-900 dark:text-white">Delivery Location</h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Moving to</p>
                                    </div>
                                </div>
                                <div className="space-y-3">
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Address</p>
                                        <p className="font-medium text-gray-900 dark:text-white">{summary.deliveryAddress}</p>
                                    </div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Floor</p>
                                        <p className="font-medium text-gray-900 dark:text-white">{summary.deliveryFloor}</p>
                                    </div>
                                    {summary.elevatorAtDelivery && (
                                        <div className="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-300 rounded-full text-sm">
                                            <FaCheckCircle className="w-4 h-4" />
                                            Elevator available
                                        </div>
                                    )}
                                </div>
                            </motion.div>
                        </div>

                        {/* Items and Costs */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {/* Items List */}
                            <motion.div
                                whileHover={{ scale: 1.01 }}
                                className="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6"
                            >
                                <div className="flex items-center gap-4 mb-6">
                                    <div className="p-3 bg-purple-100 dark:bg-purple-800 rounded-xl">
                                        <FaBoxOpen className="w-6 h-6 text-purple-600 dark:text-purple-400" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-bold text-gray-900 dark:text-white">Moving Items</h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">{summary.items?.length || 0} items selected</p>
                                    </div>
                                </div>

                                <div className="max-h-[300px] overflow-y-auto pr-2">
                                    <div className="space-y-3">
                                        {summary.items?.map((item, index) => (
                                            <motion.div
                                                key={item.id || index}
                                                initial={{ opacity: 0, x: -20 }}
                                                animate={{ opacity: 1, x: 0 }}
                                                transition={{ delay: index * 0.05 }}
                                                className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50"
                                            >
                                                <div className="flex items-center gap-3">
                                                    <div className="w-2 h-2 rounded-full bg-purple-500"></div>
                                                    <span className="font-medium text-gray-900 dark:text-white">
                                                        {item.name}
                                                    </span>
                                                </div>
                                                {item.qty && (
                                                    <span className="px-3 py-1 bg-purple-100 dark:bg-purple-800 text-purple-700 dark:text-purple-300 rounded-full text-sm font-medium">
                                                        {item.qty} {item.qty === 1 ? 'unit' : 'units'}
                                                    </span>
                                                )}
                                            </motion.div>
                                        ))}
                                    </div>
                                </div>
                            </motion.div>

                            {/* Cost Breakdown */}
                            <motion.div
                                whileHover={{ scale: 1.01 }}
                                className="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-2xl shadow-lg p-6"
                            >
                                <div className="flex items-center gap-4 mb-6">
                                    <div className="p-3 bg-amber-100 dark:bg-amber-800 rounded-xl">
                                        <FaMoneyBillWave className="w-6 h-6 text-amber-600 dark:text-amber-400" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-bold text-gray-900 dark:text-white">Cost Breakdown</h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Transparent pricing</p>
                                    </div>
                                </div>

                                <div className="space-y-4">
                                    <div className="flex justify-between items-center pb-3 border-b border-amber-200 dark:border-amber-800">
                                        <span className="text-gray-700 dark:text-gray-300">Move Cost</span>
                                        <span className="text-lg font-bold text-gray-900 dark:text-white">
                                            {formatCurrency(summary.quote)}
                                        </span>
                                    </div>

                                    {summary.vat && summary.vat > 0 && (
                                        <div className="flex justify-between items-center pb-3 border-b border-amber-200 dark:border-amber-800">
                                            <span className="text-gray-700 dark:text-gray-300">VAT (20%)</span>
                                            <span className="text-gray-900 dark:text-white">
                                                {formatCurrency(summary.vat)}
                                            </span>
                                        </div>
                                    )}

                                    <div className="flex justify-between items-center pb-3 border-b border-amber-200 dark:border-amber-800">
                                        <span className="text-gray-700 dark:text-gray-300">Deposit Required</span>
                                        <span className="text-gray-900 dark:text-white">
                                            {formatCurrency(summary.upfront)}
                                        </span>
                                    </div>

                                    <div className="flex justify-between items-center pt-2">
                                        <span className="text-lg font-semibold text-gray-900 dark:text-white">
                                            Total to Pay Now
                                        </span>
                                        <span className="text-2xl font-bold text-amber-600 dark:text-amber-400">
                                            {formatCurrency(summary.upfront)}
                                        </span>
                                    </div>

                                    <div className="mt-4 p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg">
                                        <p className="text-sm text-amber-700 dark:text-amber-300">
                                            <FaShieldAlt className="inline w-4 h-4 mr-2" />
                                            The remaining balance of {formatCurrency((summary.quote || 0) - (summary.upfront || 0))} will be due on moving day
                                        </p>
                                    </div>
                                </div>
                            </motion.div>
                        </div>

                        {/* Additional Services */}
                        {(summary.packingAtPickUp || summary.unpackingAtDelivery || summary.pickUpDate) && (
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ delay: 0.4 }}
                                className="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6"
                            >
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-6">Additional Services</h3>
                                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    {summary.pickUpDate && (
                                        <div className="flex items-center gap-3 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20">
                                            <FaCalendarAlt className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">Moving Date</p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {new Date(summary.pickUpDate).toLocaleDateString('en-GB', {
                                                        weekday: 'long',
                                                        day: 'numeric',
                                                        month: 'long',
                                                        year: 'numeric'
                                                    })}
                                                </p>
                                            </div>
                                        </div>
                                    )}

                                    {summary.packingAtPickUp && (
                                        <div className="flex items-center gap-3 p-4 rounded-xl bg-green-50 dark:bg-green-900/20">
                                            <FaBoxOpen className="w-5 h-5 text-green-600 dark:text-green-400" />
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">Packing Service</p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">At pick-up location</p>
                                            </div>
                                        </div>
                                    )}

                                    {summary.unpackingAtDelivery && (
                                        <div className="flex items-center gap-3 p-4 rounded-xl bg-purple-50 dark:bg-purple-900/20">
                                            <FaBoxOpen className="w-5 h-5 text-purple-600 dark:text-purple-400" />
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">Unpacking Service</p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">At delivery location</p>
                                            </div>
                                        </div>
                                    )}
                                </div>
                            </motion.div>
                        )}

                        {/* Action Section */}
                        <motion.div
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ delay: 0.5 }}
                            className="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-8"
                        >
                            <div className="text-center mb-8">
                                <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                                    Ready to Move Forward?
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                    Choose your preferred way to confirm your booking
                                </p>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                                {/* WhatsApp Option */}
                                <motion.button
                                    whileHover={{ scale: 1.05 }}
                                    whileTap={{ scale: 0.95 }}
                                    onClick={() => handleSubmit('whatsapp')}
                                    disabled={processingPayment}
                                    className={`p-6 rounded-xl border-2 flex flex-col items-center justify-center gap-4 transition-all ${selectedOption === 'whatsapp'
                                            ? 'border-green-500 bg-green-50 dark:bg-green-900/20'
                                            : 'border-gray-300 dark:border-gray-600 hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20'
                                        } ${processingPayment ? 'opacity-50 cursor-not-allowed' : ''}`}
                                >
                                    <div className="p-3 bg-green-100 dark:bg-green-800 rounded-full">
                                        <FaWhatsapp className="w-8 h-8 text-green-600 dark:text-green-400" />
                                    </div>
                                    <div className="text-center">
                                        <h4 className="text-lg font-bold text-gray-900 dark:text-white mb-1">
                                            Chat on WhatsApp
                                        </h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            Get instant answers and book via chat
                                        </p>
                                    </div>
                                    {selectedOption === 'whatsapp' && processingPayment && (
                                        <div className="w-5 h-5 border-2 border-green-500 border-t-transparent rounded-full animate-spin"></div>
                                    )}
                                </motion.button>

                                {/* Checkout Option */}
                                <motion.button
                                    whileHover={{ scale: 1.05 }}
                                    whileTap={{ scale: 0.95 }}
                                    onClick={() => handleSubmit('checkout')}
                                    disabled={processingPayment}
                                    className={`p-6 rounded-xl border-2 flex flex-col items-center justify-center gap-4 transition-all ${selectedOption === 'checkout'
                                            ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
                                            : 'border-gray-300 dark:border-gray-600 hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20'
                                        } ${processingPayment ? 'opacity-50 cursor-not-allowed' : ''}`}
                                >
                                    <div className="p-3 bg-blue-100 dark:bg-blue-800 rounded-full">
                                        <FaCreditCard className="w-8 h-8 text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <div className="text-center">
                                        <h4 className="text-lg font-bold text-gray-900 dark:text-white mb-1">
                                            Secure Checkout
                                        </h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            Pay deposit and book instantly
                                        </p>
                                    </div>
                                    {selectedOption === 'checkout' && processingPayment && (
                                        <div className="w-5 h-5 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                                    )}
                                </motion.button>
                            </div>

                            {/* Security Note */}
                            <div className="mt-8 text-center">
                                <div className="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                    <FaShieldAlt className="w-4 h-4" />
                                    <span>Secure SSL encryption • No hidden fees • 24/7 support</span>
                                </div>
                            </div>

                            {/* Back Button */}
                            <div className="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <button
                                    onClick={handleGoBack}
                                    className="flex items-center gap-3 mx-auto text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors"
                                >
                                    <FaArrowLeft className="w-5 h-5" />
                                    <span className="font-medium">Go back and edit details</span>
                                </button>
                            </div>
                        </motion.div>

                        {/* Next Steps */}
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            transition={{ delay: 0.6 }}
                            className="text-center"
                        >
                            <div className="inline-flex flex-wrap justify-center gap-6 text-sm text-gray-500 dark:text-gray-400">
                                <div className="flex items-center gap-2">
                                    <div className="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <span>Confirm within 24 hours for guaranteed price</span>
                                </div>
                                <div className="flex items-center gap-2">
                                    <div className="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span>Free cancellation up to 48 hours before</span>
                                </div>
                                <div className="flex items-center gap-2">
                                    <div className="w-2 h-2 rounded-full bg-purple-500"></div>
                                    <span>Insurance included</span>
                                </div>
                            </div>
                        </motion.div>
                    </motion.div>
                )}
            </AnimatePresence>
        </motion.div>
    );
}

export default Summary;