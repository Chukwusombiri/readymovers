import React, { useEffect, useRef, useState, useCallback } from 'react'
import Input from './Input'
import Label from './Label'
import { MdOutlineWrongLocation } from "react-icons/md";
import { BsCheck2Circle, BsCalendarDate, BsBoxSeam } from "react-icons/bs";
import { MdOutlineElevator } from "react-icons/md";
import { TbStairs } from "react-icons/tb";
import { FaTruckMoving } from "react-icons/fa";
import { router, usePage } from '@inertiajs/react';
import Select from './Select';
import Option from './Option';
import MoveRoute from './MoveRoute';
import PrimaryButton from './PrimaryButton';
import { motion, AnimatePresence } from 'framer-motion';

export default function QuoteGeo({ postCode, next }) {
    const page = usePage();
    const initialDeliveryDetails = JSON.parse(localStorage.getItem('deliveryDetails'));
    const defaultDeliveryDetails = {
        pickUpPostCode: postCode || '',
        pickUpAddress: null,
        deliveryPostCode: '',
        deliveryAddress: null,
        pickUpFloor: '',
        deliveryFloor: '',
        pickUpDate: new Date().toISOString().split('T')[0],
        elevatorIsAvailableAtPickUp: false,
        elevatorIsAvailableAtDelivery: false,
        packingAtPickUp: false,
        unpackingAtDelivery: false,
    };

    // Clear any previously stored data for subsequent steps if deliveryDetails is not available
    if (!initialDeliveryDetails) {
        localStorage.removeItem('quoteItems');
        localStorage.removeItem('userInfo');
    }

    const [geoData, setGeoData] = useState(initialDeliveryDetails || defaultDeliveryDetails);
    const { floors } = page.props.respData || { floors: [] };
    const [pickUpCord, setPickUpCord] = useState([]);
    const [deliveryCord, setDeliveryCord] = useState([]);
    const [errorBag, setErrorBag] = useState({});
    const [isLoading, setIsLoading] = useState({
        pickUp: false,
        delivery: false
    });
    const [touchedFields, setTouchedFields] = useState({});
    const dateRef = useRef();

    // Debounce function to limit API calls
    const debounce = (func, delay) => {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func(...args), delay);
        };
    };

    // Handle input change with validation
    const handleChange = (field, val) => {
        setGeoData(prev => ({ ...prev, [field]: val }));

        // Mark field as touched
        setTouchedFields(prev => ({ ...prev, [field]: true }));

        // Clear error when user starts typing
        if (errorBag[field]) {
            setErrorBag(prev => {
                const newErrors = { ...prev };
                delete newErrors[field];
                return newErrors;
            });
        }
    }

    // validate postcode and fetch address
    const fetchLocationData = async (postCodeValue, addressFieldName) => {
        if (!postCodeValue || postCodeValue.trim().length < 5) return;

        setIsLoading(prev => ({ ...prev, [addressFieldName === 'pickUpAddress' ? 'pickUp' : 'delivery']: true }));

        try {
            // Clean postcode
            const cleanPostCode = postCodeValue.replace(/\s+/g, '').toUpperCase();

            const response = await fetch(`https://api.postcodes.io/postcodes/${cleanPostCode}`);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            if (data.status === 200 && data.result) {
                const address = [
                    data.result.admin_district,
                    data.result.region,
                    data.result.country
                ].filter(Boolean).join(', ');

                const arr = [data.result.longitude, data.result.latitude];

                // Set the fetched address and coordinates
                setGeoData(prev => ({ ...prev, [addressFieldName]: address }));

                if (addressFieldName === 'pickUpAddress') {
                    setPickUpCord(arr);
                } else {
                    setDeliveryCord(arr);
                }

                // Clear any existing errors for the postcode fields
                setErrorBag(prev => {
                    const newErrors = { ...prev };
                    delete newErrors[addressFieldName];
                    return newErrors;
                });

            } else {
                setErrorBag(prev => ({
                    ...prev,
                    [addressFieldName]: 'Invalid postcode. Please check and try again.'
                }));

                // Clear address and coordinates if postcode is invalid
                setGeoData(prev => ({ ...prev, [addressFieldName]: null }));

                if (addressFieldName === 'pickUpAddress') {
                    setPickUpCord([]);
                } else {
                    setDeliveryCord([]);
                }
            }
        } catch (error) {
            console.error('Error fetching address:', error);
            setErrorBag(prev => ({
                ...prev,
                [addressFieldName]: 'Unable to verify postcode. Please try again.'
            }));
        } finally {
            setIsLoading(prev => ({
                ...prev,
                [addressFieldName === 'pickUpAddress' ? 'pickUp' : 'delivery']: false
            }));
        }
    };

    // Debounced version of fetchLocationData
    const debouncedFetchLocationData = useCallback(
        debounce(fetchLocationData, 500),
        []
    );

    // Handle onChange event for postcode inputs
    const handlePostCodeChange = (inputPostCodeFieldName, sisterAddressFieldName, inputPostCodeData) => {
        setGeoData(prevData => ({ ...prevData, [inputPostCodeFieldName]: inputPostCodeData }));

        // Clear address when postcode changes
        setGeoData(prevData => ({ ...prevData, [sisterAddressFieldName]: null }));

        if (inputPostCodeData.trim().length >= 5) {
            debouncedFetchLocationData(inputPostCodeData, sisterAddressFieldName);
        } else if (inputPostCodeData.trim().length === 0) {
            // Clear errors when field is empty
            setErrorBag(prev => {
                const newErrors = { ...prev };
                delete newErrors[sisterAddressFieldName];
                return newErrors;
            });
        }
    }

    /* Get location data on mount if postcode is already available*/
    useEffect(() => {
        const hasPostCode = geoData.pickUpPostCode?.trim().length >= 5;
        if (hasPostCode) {
            fetchLocationData(geoData.pickUpPostCode, 'pickUpAddress');
        }
    }, []);

    /* date initializer */
    useEffect(() => {
        const today = new Date().toISOString().split('T')[0];
        if (dateRef.current) {
            dateRef.current.setAttribute('min', today);
        }
    }, []);

    /* Handle form submission with validation */
    const handleSubmit = async (e) => {
        e.preventDefault();

        // Basic validation
        const errors = {};

        if (!geoData.pickUpPostCode?.trim()) {
            errors.pickUpAddress = 'Pick-up postcode is required';
        }

        if (!geoData.deliveryPostCode?.trim()) {
            errors.deliveryAddress = 'Delivery postcode is required';
        }

        if (!geoData.pickUpFloor) {
            errors.pickUpFloor = 'Please select pick-up floor';
        }

        if (!geoData.deliveryFloor) {
            errors.deliveryFloor = 'Please select delivery floor';
        }

        if (!geoData.pickUpDate) {
            errors.pickUpDate = 'Please select a date';
        }

        if (Object.keys(errors).length > 0) {
            setErrorBag(errors);
            return;
        }

        setIsLoading(prev => ({ ...prev, submit: true }));

        try {
            router.post('/quote/move', geoData, {
                onSuccess: () => {
                    localStorage.setItem('deliveryDetails', JSON.stringify(geoData));
                    next();
                },
                onError: (errors) => {
                    setErrorBag(errors);
                },
                preserveScroll: true
            });
        } catch (error) {
            console.error('Submission error:', error);
            setErrorBag({ submit: 'Something went wrong. Please try again.' });
        } finally {
            setIsLoading(prev => ({ ...prev, submit: false }));
        }
    };

    // Handle field blur for validation
    const handleBlur = (field) => {
        setTouchedFields(prev => ({ ...prev, [field]: true }));
    };

    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5 }}
            className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
        >
            <div className="text-center mb-10">
                <motion.h1
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.2 }}
                    className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3"
                >
                    Let's Plan Your Move
                </motion.h1>
                <p className="text-gray-600 dark:text-gray-300">
                    Enter your moving details for an accurate quote
                </p>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {/* Left Column - Form */}
                <motion.form
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.3 }}
                    className="lg:col-span-2 space-y-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8"
                    onSubmit={handleSubmit}
                >
                    {/* Form Sections */}
                    <div className="space-y-8">
                        {/* Location Section */}
                        <section className="space-y-4">
                            <div className="flex items-center gap-3 mb-6">
                                <div className="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                    <FaTruckMoving className="w-6 h-6 text-blue-600 dark:text-blue-400" />
                                </div>
                                <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                                    Moving Locations
                                </h2>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {/* Pick-up Address */}
                                <div className="space-y-3">
                                    <Label
                                        htmlFor="pickup-postCode"
                                        val="Pick-up Postal Code *"
                                        className="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    />
                                    <div className="flex items-center gap-3 relative">
                                        {isLoading.pickUp ? (
                                            <div className="w-5 h-5 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                                        ) : (
                                            <FaTruckMoving className="w-5 h-5 text-gray-400" />
                                        )}
                                        <Input
                                            type="text"
                                            name="pickUpPostCode"
                                            id="pickup-postCode"
                                            value={geoData.pickUpPostCode}
                                            onChange={(e) => handlePostCodeChange('pickUpPostCode', 'pickUpAddress', e.target.value)}
                                            onBlur={() => handleBlur('pickUpPostCode')}
                                            placeholder="e.g., SW1A 1AA"
                                            className={`pl-10 pr-4 py-3 w-full rounded-lg border transition-all duration-200 ${errorBag.pickUpAddress
                                                ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                                : geoData.pickUpAddress
                                                    ? 'border-green-500 dark:border-green-500'
                                                    : 'border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900'
                                                }`}
                                            required
                                        />
                                    </div>

                                    <AnimatePresence>
                                        {geoData.pickUpAddress && (
                                            <motion.p
                                                initial={{ opacity: 0, height: 0 }}
                                                animate={{ opacity: 1, height: 'auto' }}
                                                exit={{ opacity: 0, height: 0 }}
                                                className="text-green-600 dark:text-green-400 text-sm flex items-center gap-2 bg-green-50 dark:bg-green-900/20 p-3 rounded-lg"
                                            >
                                                <BsCheck2Circle className="flex-shrink-0" />
                                                <span>{geoData.pickUpAddress}</span>
                                            </motion.p>
                                        )}

                                        {errorBag.pickUpAddress && (
                                            <motion.p
                                                initial={{ opacity: 0 }}
                                                animate={{ opacity: 1 }}
                                                className="text-red-600 dark:text-red-400 text-sm flex items-center gap-2 bg-red-50 dark:bg-red-900/20 p-3 rounded-lg"
                                            >
                                                <MdOutlineWrongLocation />
                                                {errorBag.pickUpAddress}
                                            </motion.p>
                                        )}
                                    </AnimatePresence>
                                </div>

                                {/* Delivery Address */}
                                <div className="space-y-3">
                                    <Label
                                        htmlFor="dropoff-postCode"
                                        val="Delivery Postal Code *"
                                        className="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    />
                                    <div className="flex items-center gap-3 relative">
                                        {isLoading.delivery ? (
                                            <div className="w-5 h-5 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                                        ) : (
                                            <FaTruckMoving className="w-5 h-5 text-gray-400" />
                                        )}
                                        <Input
                                            type="text"
                                            name="deliveryPostCode"
                                            id="dropoff-postCode"
                                            value={geoData.deliveryPostCode}
                                            onChange={(e) => handlePostCodeChange('deliveryPostCode', 'deliveryAddress', e.target.value)}
                                            onBlur={() => handleBlur('deliveryPostCode')}
                                            placeholder="e.g., EC1A 1BB"
                                            className={`pl-10 pr-4 py-3 w-full rounded-lg border transition-all duration-200 ${errorBag.deliveryAddress
                                                ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                                : geoData.deliveryAddress
                                                    ? 'border-green-500 dark:border-green-500'
                                                    : 'border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900'
                                                }`}
                                            required
                                        />
                                    </div>

                                    <AnimatePresence>
                                        {geoData.deliveryAddress && (
                                            <motion.p
                                                initial={{ opacity: 0, height: 0 }}
                                                animate={{ opacity: 1, height: 'auto' }}
                                                exit={{ opacity: 0, height: 0 }}
                                                className="text-green-600 dark:text-green-400 text-sm flex items-center gap-2 bg-green-50 dark:bg-green-900/20 p-3 rounded-lg"
                                            >
                                                <BsCheck2Circle className="flex-shrink-0" />
                                                <span>{geoData.deliveryAddress}</span>
                                            </motion.p>
                                        )}

                                        {errorBag.deliveryAddress && (
                                            <motion.p
                                                initial={{ opacity: 0 }}
                                                animate={{ opacity: 1 }}
                                                className="text-red-600 dark:text-red-400 text-sm flex items-center gap-2 bg-red-50 dark:bg-red-900/20 p-3 rounded-lg"
                                            >
                                                <MdOutlineWrongLocation />
                                                {errorBag.deliveryAddress}
                                            </motion.p>
                                        )}
                                    </AnimatePresence>
                                </div>
                            </div>
                        </section>

                        {/* Floors Section */}
                        <section className="space-y-4">
                            <div className="flex items-center gap-3 mb-6">
                                <div className="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                    <TbStairs className="w-6 h-6 text-purple-600 dark:text-purple-400" />
                                </div>
                                <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                                    Floor Information
                                </h2>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div className="flex flex-col space-y-3">
                                    <Label
                                        htmlFor="pickUpFloor"
                                        val="Pick-up Floor *"
                                        className="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    />
                                    <Select
                                        name="pickUpFloor"
                                        id="pickUpFloor"
                                        value={geoData.pickUpFloor}
                                        onChange={(e) => handleChange('pickUpFloor', e.target.value)}
                                        onBlur={() => handleBlur('pickUpFloor')}
                                        className={`w-full px-4 py-3 rounded-lg border transition-all duration-200 ${errorBag.pickUpFloor
                                            ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                            : 'border-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900'
                                            }`}
                                    >
                                        <Option val="" placeholder="Select floor level" />
                                        {floors.map(floor => (
                                            <Option key={floor.id} val={floor.name} placeholder={floor.name} />
                                        ))}
                                    </Select>
                                    {errorBag.pickUpFloor && (
                                        <p className="text-red-600 dark:text-red-400 text-sm mt-1">
                                            {errorBag.pickUpFloor}
                                        </p>
                                    )}
                                </div>

                                <div className="flex flex-col space-y-3">
                                    <Label
                                        htmlFor="deliveryFloor"
                                        val="Delivery Floor *"
                                        className="text-sm font-medium text-gray-700 dark:text-gray-300"
                                    />
                                    <Select
                                        name="deliveryFloor"
                                        id="deliveryFloor"
                                        value={geoData.deliveryFloor}
                                        onChange={(e) => handleChange('deliveryFloor', e.target.value)}
                                        onBlur={() => handleBlur('deliveryFloor')}
                                        className={`w-full px-4 py-3 rounded-lg border transition-all duration-200 ${errorBag.deliveryFloor
                                            ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                            : 'border-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900'
                                            }`}
                                    >
                                        <Option val="" placeholder="Select floor level" />
                                        {floors.map(floor => (
                                            <Option key={floor.id} val={floor.name} placeholder={floor.name} />
                                        ))}
                                    </Select>
                                    {errorBag.deliveryFloor && (
                                        <p className="text-red-600 dark:text-red-400 text-sm mt-1">
                                            {errorBag.deliveryFloor}
                                        </p>
                                    )}
                                </div>
                            </div>
                        </section>

                        {/* Additional Services */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {/* Elevator Section */}
                            <section className="space-y-4">
                                <div className="flex items-center gap-3 mb-4">
                                    <div className="p-2 bg-amber-100 dark:bg-amber-900 rounded-lg">
                                        <MdOutlineElevator className="w-6 h-6 text-amber-600 dark:text-amber-400" />
                                    </div>
                                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                        Elevator Access
                                    </h2>
                                </div>

                                <div className="space-y-4">
                                    <div className="flex items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <div className="relative">
                                            <input
                                                type="checkbox"
                                                checked={geoData.elevatorIsAvailableAtPickUp}
                                                onChange={(e) => handleChange('elevatorIsAvailableAtPickUp', e.target.checked)}
                                                id="elevatorIsAvailableAtPickUp"
                                                className="sr-only peer"
                                            />
                                            <div className="w-6 h-6 rounded border-2 border-gray-300 dark:border-gray-600 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors flex items-center justify-center">
                                                {geoData.elevatorIsAvailableAtPickUp && (
                                                    <svg className="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                                                    </svg>
                                                )}
                                            </div>
                                        </div>
                                        <Label
                                            htmlFor="elevatorIsAvailableAtPickUp"
                                            val="Elevator at pick-up location"
                                            className="text-gray-700 dark:text-gray-300 cursor-pointer flex-1"
                                        />
                                    </div>

                                    <div className="flex items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <div className="relative">
                                            <input
                                                type="checkbox"
                                                checked={geoData.elevatorIsAvailableAtDelivery}
                                                onChange={(e) => handleChange('elevatorIsAvailableAtDelivery', e.target.checked)}
                                                id="elevatorIsAvailableAtDelivery"
                                                className="sr-only peer"
                                            />
                                            <div className="w-6 h-6 rounded border-2 border-gray-300 dark:border-gray-600 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors flex items-center justify-center">
                                                {geoData.elevatorIsAvailableAtDelivery && (
                                                    <svg className="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                                                    </svg>
                                                )}
                                            </div>
                                        </div>
                                        <Label
                                            htmlFor="elevatorIsAvailableAtDelivery"
                                            val="Elevator at delivery location"
                                            className="text-gray-700 dark:text-gray-300 cursor-pointer flex-1"
                                        />
                                    </div>
                                </div>
                            </section>

                            {/* Packing Services */}
                            <section className="space-y-4">
                                <div className="flex items-center gap-3 mb-4">
                                    <div className="p-2 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                                        <BsBoxSeam className="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                        Additional Services
                                    </h2>
                                </div>

                                <div className="space-y-4">
                                    <div className="flex items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <div className="relative">
                                            <input
                                                type="checkbox"
                                                checked={geoData.packingAtPickUp}
                                                onChange={(e) => handleChange('packingAtPickUp', e.target.checked)}
                                                id="packingAtPickUp"
                                                className="sr-only peer"
                                            />
                                            <div className="w-6 h-6 rounded border-2 border-gray-300 dark:border-gray-600 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 transition-colors flex items-center justify-center">
                                                {geoData.packingAtPickUp && (
                                                    <svg className="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                                                    </svg>
                                                )}
                                            </div>
                                        </div>
                                        <Label
                                            htmlFor="packingAtPickUp"
                                            val="Help with packing"
                                            className="text-gray-700 dark:text-gray-300 cursor-pointer flex-1"
                                        />
                                    </div>

                                    <div className="flex items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <div className="relative">
                                            <input
                                                type="checkbox"
                                                checked={geoData.unpackingAtDelivery}
                                                onChange={(e) => handleChange('unpackingAtDelivery', e.target.checked)}
                                                id="unpackingAtDelivery"
                                                className="sr-only peer"
                                            />
                                            <div className="w-6 h-6 rounded border-2 border-gray-300 dark:border-gray-600 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 transition-colors flex items-center justify-center">
                                                {geoData.unpackingAtDelivery && (
                                                    <svg className="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                                                    </svg>
                                                )}
                                            </div>
                                        </div>
                                        <Label
                                            htmlFor="unpackingAtDelivery"
                                            val="Help with unpacking"
                                            className="text-gray-700 dark:text-gray-300 cursor-pointer flex-1"
                                        />
                                    </div>
                                </div>
                            </section>
                        </div>

                        {/* Date Section */}
                        <section className="space-y-4">
                            <div className="flex items-center gap-3 mb-4">
                                <div className="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                    <BsCalendarDate className="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                                </div>
                                <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    Moving Date *
                                </h2>
                            </div>

                            <div className="relative max-w-md">
                                <input
                                    ref={dateRef}
                                    type="date"
                                    name="pickUpDate"
                                    id="pickUpDate"
                                    value={geoData.pickUpDate}
                                    onChange={(e) => handleChange('pickUpDate', e.target.value)}
                                    onBlur={() => handleBlur('pickUpDate')}
                                    className={`w-full px-4 py-3 rounded-lg border transition-all duration-200 ${errorBag.pickUpDate
                                        ? 'border-red-500 dark:border-red-500 focus:ring-red-500'
                                        : 'border-gray-300 dark:border-gray-600 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-900'
                                        }`}
                                    required
                                />
                                {errorBag.pickUpDate && (
                                    <p className="text-red-600 dark:text-red-400 text-sm mt-2">
                                        {errorBag.pickUpDate}
                                    </p>
                                )}
                            </div>
                        </section>
                    </div>

                    {/* Submit Button */}
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.5 }}
                        className="pt-6 border-t border-gray-200 dark:border-gray-700"
                    >
                        {errorBag.submit && (
                            <div className="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <p className="text-red-600 dark:text-red-400 text-center">
                                    {errorBag.submit}
                                </p>
                            </div>
                        )}

                        <PrimaryButton
                            type="submit"
                            disabled={isLoading.submit}
                            className="w-full md:w-auto min-w-[200px] py-3 px-8 rounded-lg text-lg font-medium transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl"
                        >
                            {isLoading.submit ? (
                                <span className="flex items-center justify-center gap-2">
                                    <div className="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                    Processing...
                                </span>
                            ) : (
                                <span className="flex items-center justify-center gap-2">
                                    Continue to Next Step
                                    <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            )}
                        </PrimaryButton>
                    </motion.div>
                </motion.form>

                {/* Right Column - Map Preview */}
                <motion.div
                    initial={{ opacity: 0, x: 20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.4 }}
                    className="lg:col-span-1"
                >
                    <div className="sticky top-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-6 h-full">
                        <div className="mb-6">
                            <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                Route Preview
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 text-sm">
                                {pickUpCord.length > 0 && deliveryCord.length > 0
                                    ? "Your moving route will appear here"
                                    : "Enter both addresses to see the route"
                                }
                            </p>
                        </div>

                        <div className="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 h-96">
                            <MoveRoute pickUpCord={pickUpCord} deliveryCord={deliveryCord} />
                        </div>

                        {/* Summary Card */}
                        <div className="mt-6 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                            <h4 className="font-semibold text-gray-900 dark:text-white mb-3">
                                Move Summary
                            </h4>
                            <div className="space-y-2 text-sm">
                                <div className="flex justify-between">
                                    <span className="text-gray-600 dark:text-gray-400">Pick-up:</span>
                                    <span className="font-medium text-gray-900 dark:text-white">
                                        {geoData.pickUpAddress ? '✓ Address verified' : 'Enter postcode'}
                                    </span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-gray-600 dark:text-gray-400">Delivery:</span>
                                    <span className="font-medium text-gray-900 dark:text-white">
                                        {geoData.deliveryAddress ? '✓ Address verified' : 'Enter postcode'}
                                    </span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-gray-600 dark:text-gray-400">Date:</span>
                                    <span className="font-medium text-gray-900 dark:text-white">
                                        {new Date(geoData.pickUpDate).toLocaleDateString('en-GB', {
                                            weekday: 'short',
                                            day: 'numeric',
                                            month: 'short',
                                            year: 'numeric'
                                        })}
                                    </span>
                                </div>
                                <div className="pt-3 border-t border-gray-100 dark:border-gray-700 mt-3">
                                    <div className="flex justify-between items-center">
                                        <span className="text-gray-600 dark:text-gray-400">Total Services:</span>
                                        <span className="font-semibold text-blue-600 dark:text-blue-400">
                                            {[
                                                geoData.elevatorIsAvailableAtPickUp,
                                                geoData.elevatorIsAvailableAtDelivery,
                                                geoData.packingAtPickUp,
                                                geoData.unpackingAtDelivery
                                            ].filter(Boolean).length} selected
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </motion.div>
            </div>
        </motion.div>
    )
}