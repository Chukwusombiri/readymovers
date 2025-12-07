import React, { useState, useEffect, useCallback } from 'react'
import { FaArrowLeft, FaUser, FaEnvelope, FaPhone, FaCheckCircle } from 'react-icons/fa';
import { motion, AnimatePresence } from 'framer-motion';
import axios from 'axios';
import { toast } from 'react-toastify';
import Input from './Input'
import PrimaryButton from './PrimaryButton'
import Label from './Label'

export default function QuoteUserInfo({ next, prev }) {
    // Initialize from localStorage with proper validation
    const [userInfo, setUserInfo] = useState(() => {
        try {
            const stored = localStorage.getItem('userInfo');
            if (stored) {
                const parsed = JSON.parse(stored);
                // Validate stored data structure
                if (parsed.username && parsed.email && parsed.phone) {
                    return parsed;
                }
            }
        } catch (error) {
            console.error('Error parsing user info:', error);
        }
        return {
            username: '',
            email: '',
            phone: '',
        };
    });

    const [errors, setErrors] = useState({});
    const [touched, setTouched] = useState({});
    const [loading, setLoading] = useState(false);
    const [isValid, setIsValid] = useState({
        username: false,
        email: false,
        phone: false
    });

    // Save to localStorage when userInfo changes
    useEffect(() => {
        localStorage.setItem('userInfo', JSON.stringify(userInfo));
    }, [userInfo]);

    // Validate all fields on mount and when userInfo changes
    useEffect(() => {
        const validateAllFields = () => {
            const newErrors = {};
            const newIsValid = { ...isValid };

            // Validate username
            if (touched.username || userInfo.username) {
                if (!userInfo.username.trim()) {
                    newErrors.username = 'Full name is required';
                    newIsValid.username = false;
                } else if (userInfo.username.trim().length < 2) {
                    newErrors.username = 'Name must be at least 2 characters';
                    newIsValid.username = false;
                } else {
                    newIsValid.username = true;
                }
            }

            // Validate email
            if (touched.email || userInfo.email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!userInfo.email.trim()) {
                    newErrors.email = 'Email is required';
                    newIsValid.email = false;
                } else if (!emailRegex.test(userInfo.email.trim())) {
                    newErrors.email = 'Please enter a valid email address';
                    newIsValid.email = false;
                } else {
                    newIsValid.email = true;
                }
            }

            // Validate phone
            if (touched.phone || userInfo.phone) {
                const phoneRegex = /^[\+]?[1-9][\d]{0,15}$|^[\+]?[1-9][\d]{0,15}[\s]?[\-]?[\s]?[\(]?[\d]{1,}[\)]?[\s]?[\-]?[\s]?[\d]{1,}[\s]?[\-]?[\s]?[\d]{1,}$/;
                if (!userInfo.phone.trim()) {
                    newErrors.phone = 'Phone number is required';
                    newIsValid.phone = false;
                } else if (!phoneRegex.test(userInfo.phone.replace(/[\s\-\(\)]/g, ''))) {
                    newErrors.phone = 'Please enter a valid phone number';
                    newIsValid.phone = false;
                } else {
                    newIsValid.phone = true;
                }
            }

            setErrors(newErrors);
            setIsValid(newIsValid);
        };

        validateAllFields();
    }, [userInfo, touched]);

    // Check if all fields are valid
    const allFieldsValid = useCallback(() => {
        return isValid.username && isValid.email && isValid.phone;
    }, [isValid]);

    // Handlers for input changes and blur events
    const handleChange = useCallback((field, value) => {
        setUserInfo(prev => ({ ...prev, [field]: value }));

        // Clear error for this field when user starts typing
        if (errors[field]) {
            setErrors(prev => ({ ...prev, [field]: '' }));
        }
    }, [errors]);

    // handler for input blur to mark fields as touched
    const handleBlur = useCallback((field) => {
        setTouched(prev => ({ ...prev, [field]: true }));
    }, []);

    // Phone number formatting
    const formatPhoneNumber = useCallback((value) => {
        // Remove all non-digit characters
        const phoneNumber = value.replace(/\D/g, '');

        // Format as: (XXX) XXX-XXXX for US numbers
        if (phoneNumber.length === 10) {
            return `(${phoneNumber.slice(0, 3)}) ${phoneNumber.slice(3, 6)}-${phoneNumber.slice(6)}`;
        }

        // Return raw value for international numbers
        return value;
    }, []);

    // Phone input change handler with cleaning of unwanted characters
    const handlePhoneChange = useCallback((value) => {
        // Allow only numbers, spaces, parentheses, and hyphens
        const cleaned = value.replace(/[^\d\s\-\(\)]/g, '');
        handleChange('phone', cleaned);
    }, [handleChange]);

    // Form submission handler 
    const handleSubmit = useCallback(async (e) => {
        e.preventDefault();

        // Mark all fields as touched to show errors
        setTouched({
            username: true,
            email: true,
            phone: true
        });

        // Check if all fields are valid
        if (!allFieldsValid()) {
            toast.error('Please fix all errors before submitting');
            return;
        }

        setLoading(true);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            const response = await axios.post('/api/move/user-info', userInfo, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                credentials: 'include'
            });

            if (response.data.success) {
                localStorage.setItem('userInfo', JSON.stringify(userInfo));
                toast.success('Contact information saved successfully!');
                next();
            }
        } catch (error) {
            if (error.response?.status === 422) {
                const serverErrors = error.response.data.errors;
                setErrors(serverErrors);

                // Mark all errored fields as touched
                const newTouched = { ...touched };
                Object.keys(serverErrors).forEach(key => {
                    newTouched[key] = true;
                });
                setTouched(newTouched);

                toast.error('Please fix the errors in the form');
            } else if (error.response?.status === 401) {
                toast.error('Session expired. Please refresh the page.');
            } else {
                console.error('Submission error:', error);
                toast.error('Something went wrong. Please try again.');
            }
        } finally {
            setLoading(false);
        }
    }, [userInfo, touched, allFieldsValid, next]);

    // Handler for going back to previous step
    const handleGoBack = useCallback(() => {
        localStorage.setItem('userInfo', JSON.stringify(userInfo));
        prev();
    }, [userInfo, prev]);

    const allFieldsFilled = userInfo.username && userInfo.email && userInfo.phone;

    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5 }}
            className="max-w-4xl mx-auto"
        >
            {/* Header */}
            <div className="text-center mb-10">
                <motion.h2
                    initial={{ y: -10, opacity: 0 }}
                    animate={{ y: 0, opacity: 1 }}
                    transition={{ delay: 0.2 }}
                    className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3"
                >
                    Your Contact Information
                </motion.h2>
                <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    We'll use this information to send your quote and coordinate the move
                </p>
            </div>

            {/* Progress Indicator */}
            <div className="max-w-xl mx-auto mb-8">
                <div className="flex items-center justify-between mb-4">
                    <div className="text-center">
                        <div className={`w-12 h-12 rounded-full flex items-center justify-center mb-2 ${allFieldsFilled ? 'bg-green-100 dark:bg-green-900/30 border-2 border-green-500' : 'bg-gray-100 dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600'
                            }`}>
                            {allFieldsFilled ? (
                                <FaCheckCircle className="w-6 h-6 text-green-600 dark:text-green-400" />
                            ) : (
                                <span className="text-lg font-bold text-gray-600 dark:text-gray-400">3/3</span>
                            )}
                        </div>
                        <span className="text-sm text-gray-600 dark:text-gray-400">Step 3 of 3</span>
                    </div>
                    <div className="flex-1 mx-4">
                        <div className="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <motion.div
                                initial={{ width: '66%' }}
                                animate={{ width: allFieldsFilled ? '100%' : '100%' }}
                                transition={{ duration: 0.5 }}
                                className="h-full bg-gradient-to-r from-blue-500 to-purple-500"
                            />
                        </div>
                    </div>
                    <div className="text-center">
                        <div className={`w-12 h-12 rounded-full flex items-center justify-center mb-2 ${allFieldsValid() ? 'bg-green-100 dark:bg-green-900/30 border-2 border-green-500' : 'bg-gray-100 dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600'
                            }`}>
                            {allFieldsValid() ? (
                                <FaCheckCircle className="w-6 h-6 text-green-600 dark:text-green-400" />
                            ) : (
                                <span className="text-lg font-bold text-gray-600 dark:text-gray-400">✓</span>
                            )}
                        </div>
                        <span className="text-sm text-gray-600 dark:text-gray-400">Ready</span>
                    </div>
                </div>
            </div>

            {/* Form Container */}
            <motion.form
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ delay: 0.3 }}
                onSubmit={handleSubmit}
                className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8 max-w-xl mx-auto"
            >
                <div className="space-y-6">
                    {/* Name Field */}
                    <div className="space-y-2">
                        <div className="flex items-center justify-between">
                            <Label
                                htmlFor="username"
                                val="Full Name *"
                                className="text-sm font-medium text-gray-700 dark:text-gray-300"
                            />
                            {isValid.username && (
                                <motion.div
                                    initial={{ scale: 0 }}
                                    animate={{ scale: 1 }}
                                    className="flex items-center gap-1 text-green-600 dark:text-green-400 text-sm"
                                >
                                    <FaCheckCircle className="w-4 h-4" />
                                    <span>Valid</span>
                                </motion.div>
                            )}
                        </div>
                        <div className="relative">
                            <div className="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <FaUser className={`w-5 h-5 ${errors.username ? 'text-red-500' : isValid.username ? 'text-green-500' : 'text-gray-400'}`} />
                            </div>
                            <input
                                type="text"
                                id="username"
                                value={userInfo.username}
                                onChange={(e) => handleChange('username', e.target.value)}
                                onBlur={() => handleBlur('username')}
                                placeholder="Enter your full name"
                                className={`pl-12 pr-4 py-3 w-full rounded-lg border transition-all duration-200 ${errors.username
                                        ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                        : isValid.username
                                            ? 'border-green-500 dark:border-green-500 focus:ring-green-500'
                                            : 'border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900'
                                    }`}
                                required
                            />
                        </div>
                        <AnimatePresence>
                            {errors.username && (
                                <motion.p
                                    initial={{ opacity: 0, height: 0 }}
                                    animate={{ opacity: 1, height: 'auto' }}
                                    exit={{ opacity: 0, height: 0 }}
                                    className="text-red-600 dark:text-red-400 text-sm mt-1"
                                >
                                    {errors.username}
                                </motion.p>
                            )}
                        </AnimatePresence>
                        {!errors.username && touched.username && (
                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                We'll use this name for your moving documents
                            </p>
                        )}
                    </div>

                    {/* Email Field */}
                    <div className="space-y-2">
                        <div className="flex items-center justify-between">
                            <Label
                                htmlFor="email"
                                val="Email Address *"
                                className="text-sm font-medium text-gray-700 dark:text-gray-300"
                            />
                            {isValid.email && (
                                <motion.div
                                    initial={{ scale: 0 }}
                                    animate={{ scale: 1 }}
                                    className="flex items-center gap-1 text-green-600 dark:text-green-400 text-sm"
                                >
                                    <FaCheckCircle className="w-4 h-4" />
                                    <span>Valid</span>
                                </motion.div>
                            )}
                        </div>
                        <div className="relative">
                            <div className="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <FaEnvelope className={`w-5 h-5 ${errors.email ? 'text-red-500' : isValid.email ? 'text-green-500' : 'text-gray-400'}`} />
                            </div>
                            <input
                                type="email"
                                id="email"
                                value={userInfo.email}
                                onChange={(e) => handleChange('email', e.target.value)}
                                onBlur={() => handleBlur('email')}
                                placeholder="you@example.com"
                                className={`pl-12 pr-4 py-3 w-full rounded-lg border transition-all duration-200 ${errors.email
                                        ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                        : isValid.email
                                            ? 'border-green-500 dark:border-green-500 focus:ring-green-500'
                                            : 'border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900'
                                    }`}
                                required
                            />
                        </div>
                        <AnimatePresence>
                            {errors.email && (
                                <motion.p
                                    initial={{ opacity: 0, height: 0 }}
                                    animate={{ opacity: 1, height: 'auto' }}
                                    exit={{ opacity: 0, height: 0 }}
                                    className="text-red-600 dark:text-red-400 text-sm mt-1"
                                >
                                    {errors.email}
                                </motion.p>
                            )}
                        </AnimatePresence>
                        {!errors.email && touched.email && (
                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                Your quote and booking confirmation will be sent here
                            </p>
                        )}
                    </div>

                    {/* Phone Field */}
                    <div className="space-y-2">
                        <div className="flex items-center justify-between">
                            <Label
                                htmlFor="phone"
                                val="Phone Number *"
                                className="text-sm font-medium text-gray-700 dark:text-gray-300"
                            />
                            {isValid.phone && (
                                <motion.div
                                    initial={{ scale: 0 }}
                                    animate={{ scale: 1 }}
                                    className="flex items-center gap-1 text-green-600 dark:text-green-400 text-sm"
                                >
                                    <FaCheckCircle className="w-4 h-4" />
                                    <span>Valid</span>
                                </motion.div>
                            )}
                        </div>
                        <div className="relative">
                            <div className="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <FaPhone className={`w-5 h-5 ${errors.phone ? 'text-red-500' : isValid.phone ? 'text-green-500' : 'text-gray-400'}`} />
                            </div>
                            <input
                                type="tel"
                                id="phone"
                                value={formatPhoneNumber(userInfo.phone)}
                                onChange={(e) => handlePhoneChange(e.target.value)}
                                onBlur={() => handleBlur('phone')}
                                placeholder="(123) 456-7890"
                                className={`pl-12 pr-4 py-3 w-full rounded-lg border transition-all duration-200 ${errors.phone
                                        ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                        : isValid.phone
                                            ? 'border-green-500 dark:border-green-500 focus:ring-green-500'
                                            : 'border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900'
                                    }`}
                                required
                            />
                        </div>
                        <AnimatePresence>
                            {errors.phone && (
                                <motion.p
                                    initial={{ opacity: 0, height: 0 }}
                                    animate={{ opacity: 1, height: 'auto' }}
                                    exit={{ opacity: 0, height: 0 }}
                                    className="text-red-600 dark:text-red-400 text-sm mt-1"
                                >
                                    {errors.phone}
                                </motion.p>
                            )}
                        </AnimatePresence>
                        {!errors.phone && touched.phone && (
                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                We'll call to confirm details and for any urgent updates
                            </p>
                        )}
                    </div>
                </div>

                {/* Privacy Note */}
                <div className="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <div className="flex items-start gap-3">
                        <div className="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                            <FaCheckCircle className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <h4 className="font-medium text-gray-900 dark:text-white mb-1">
                                Your Information is Secure
                            </h4>
                            <p className="text-sm text-gray-600 dark:text-gray-300">
                                We'll only use your contact information to send your quote and coordinate your move.
                                We never share your details with third parties.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Action Buttons */}
                <div className="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div className="flex flex-col md:flex-row gap-4 justify-between items-center">
                        <button
                            type="button"
                            onClick={handleGoBack}
                            className="flex items-center gap-3 px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"
                        >
                            <FaArrowLeft className="w-5 h-5" />
                            <span className="font-medium">Go Back</span>
                        </button>

                        <div className="flex flex-col md:flex-row items-center gap-4">
                            {allFieldsValid() && (
                                <motion.div
                                    initial={{ opacity: 0, scale: 0.8 }}
                                    animate={{ opacity: 1, scale: 1 }}
                                    className="text-sm text-green-600 dark:text-green-400 flex items-center gap-2"
                                >
                                    <FaCheckCircle className="w-4 h-4" />
                                    <span>All fields are valid!</span>
                                </motion.div>
                            )}

                            <PrimaryButton
                                type="submit"
                                disabled={!allFieldsValid() || loading}
                                className="min-w-[200px] py-3 px-8 text-lg font-medium transition-all duration-300 hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                            >
                                {loading ? (
                                    <span className="flex items-center justify-center gap-2">
                                        <div className="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                        Processing...
                                    </span>
                                ) : (
                                    <span className="flex items-center justify-center gap-2">
                                        Complete & Get Quote
                                        <FaCheckCircle className="w-5 h-5" />
                                    </span>
                                )}
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </motion.form>

            {/* Next Steps Info */}
            <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.5 }}
                className="mt-8 text-center"
            >
                <p className="text-gray-600 dark:text-gray-300">
                    After submitting, you'll receive:
                </p>
                <div className="flex flex-wrap justify-center gap-4 mt-3">
                    <div className="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <div className="w-2 h-2 rounded-full bg-blue-500"></div>
                        <span>Instant quote via email</span>
                    </div>
                    <div className="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <div className="w-2 h-2 rounded-full bg-green-500"></div>
                        <span>Follow-up call within 24 hours</span>
                    </div>
                    <div className="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <div className="w-2 h-2 rounded-full bg-purple-500"></div>
                        <span>Option to book immediately</span>
                    </div>
                </div>
            </motion.div>
        </motion.div>
    );
}