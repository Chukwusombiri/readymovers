import React, { useEffect } from 'react';
import { Link } from '@inertiajs/react';
import { 
  FaHome, 
  FaSearch, 
  FaExclamationTriangle, 
  FaArrowLeft,
  FaMapSigns,
  FaQuestionCircle
} from 'react-icons/fa';
import { motion } from 'framer-motion';
import { usePage } from '@inertiajs/react';

export default function NotFound() {
    const page = usePage();
    const isDark = page.props.isDark || false;

    // Animation variants
    const containerVariants = {
        hidden: { opacity: 0 },
        visible: {
            opacity: 1,
            transition: {
                staggerChildren: 0.1,
                delayChildren: 0.2
            }
        }
    };

    const itemVariants = {
        hidden: { y: 20, opacity: 0 },
        visible: {
            y: 0,
            opacity: 1,
            transition: {
                type: "spring",
                stiffness: 100,
                damping: 12
            }
        }
    };

    const iconVariants = {
        hidden: { scale: 0, rotate: -180 },
        visible: {
            scale: 1,
            rotate: 0,
            transition: {
                type: "spring",
                stiffness: 260,
                damping: 20,
                delay: 0.5
            }
        }
    };

    const numberVariants = {
        hidden: { scale: 0, opacity: 0 },
        visible: (i) => ({
            scale: 1,
            opacity: 1,
            transition: {
                type: "spring",
                stiffness: 300,
                damping: 15,
                delay: 0.3 + i * 0.1
            }
        })
    };

    const floatingAnimation = {
        y: [0, -10, 0],
        transition: {
            duration: 3,
            repeat: Infinity,
            ease: "easeInOut"
        }
    };

    return (
        <div className="min-h-screen py-12 md:py-32 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 flex flex-col items-center justify-center p-4">
            <motion.div 
                variants={containerVariants}
                initial="hidden"
                animate="visible"
                className="max-w-4xl mx-auto text-center"
            >
                {/* 404 Number Display */}
                <div className="relative mb-8 md:mb-12">
                    <div className="flex justify-center items-center gap-2 md:gap-4 mb-6">
                        {[4, 0, 4].map((num, index) => (
                            <motion.div
                                key={index}
                                custom={index}
                                variants={numberVariants}
                                whileHover={{ scale: 1.1, y: -5 }}
                                className="relative"
                            >
                                <div className={`text-8xl md:text-9xl lg:text-[12rem] font-black ${
                                    isDark 
                                        ? 'text-gray-800 dark:text-gray-700' 
                                        : 'text-gray-300'
                                }`}>
                                    {num}
                                </div>
                                <div className="absolute inset-0 flex items-center justify-center">
                                    <div className={`text-8xl md:text-9xl lg:text-[12rem] font-black bg-gradient-to-r from-red-500 via-orange-500 to-amber-500 dark:from-red-600 dark:via-orange-600 dark:to-amber-600 bg-clip-text text-transparent`}>
                                        {num}
                                    </div>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                    
                    {/* Floating Icon */}
                    <motion.div
                        variants={iconVariants}
                        animate={floatingAnimation}
                        className="absolute -top-4 right-1/4 md:right-1/3"
                    >
                        <div className="p-3 bg-gradient-to-r from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 rounded-full">
                            <FaExclamationTriangle className="w-8 h-8 text-red-500 dark:text-red-400" />
                        </div>
                    </motion.div>
                </div>

                {/* Main Message */}
                <motion.div variants={itemVariants} className="mb-8">
                    <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        Page Not Found
                    </h1>
                    <p className="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Oops! The page you're looking for seems to have wandered off into the digital void.
                    </p>
                </motion.div>

                {/* Search & Navigation Section */}
                <motion.div 
                    variants={itemVariants}
                    className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8 mb-8 max-w-2xl mx-auto"
                >
                    <div className="flex items-center gap-3 mb-6">
                        <div className="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <FaMapSigns className="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                                Let's Get You Back on Track
                            </h2>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                Here are some helpful options
                            </p>
                        </div>
                    </div>

                    {/* Search Bar */}
                    <div className="relative mb-6">
                        <FaSearch className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                        <input
                            type="text"
                            placeholder="Search for pages or content..."
                            className="w-full pl-12 pr-4 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900 focus:ring-opacity-50 transition-all"
                            onKeyPress={(e) => {
                                if (e.key === 'Enter') {
                                    window.location.href = `/search?q=${e.target.value}`;
                                }
                            }}
                        />
                    </div>

                    {/* Quick Links Grid */}
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <Link
                            href="/"
                            className="group p-4 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl border border-blue-200 dark:border-blue-800 hover:border-blue-500 dark:hover:border-blue-400 transition-all"
                        >
                            <div className="flex items-center gap-3">
                                <div className="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg group-hover:scale-110 transition-transform">
                                    <FaHome className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                </div>
                                <div className="text-left">
                                    <h3 className="font-semibold text-gray-900 dark:text-white">
                                        Return Home
                                    </h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        Back to safety
                                    </p>
                                </div>
                            </div>
                        </Link>

                        <Link
                            href={route('contact')}
                            className="group p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800 hover:border-green-500 dark:hover:border-green-400 transition-all"
                        >
                            <div className="flex items-center gap-3">
                                <div className="p-2 bg-green-100 dark:bg-green-800 rounded-lg group-hover:scale-110 transition-transform">
                                    <FaQuestionCircle className="w-5 h-5 text-green-600 dark:text-green-400" />
                                </div>
                                <div className="text-left">
                                    <h3 className="font-semibold text-gray-900 dark:text-white">
                                        Get Help
                                    </h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        Contact support
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </div>

                    {/* Browser Actions */}
                    <div className="flex flex-wrap gap-3 justify-center">
                        <button
                            onClick={() => window.history.back()}
                            className="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors"
                        >
                            <FaArrowLeft className="w-4 h-4" />
                            Go Back
                        </button>
                        <button
                            onClick={() => window.location.reload()}
                            className="px-4 py-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors"
                        >
                            Refresh Page
                        </button>
                    </div>
                </motion.div>

                {/* Helpful Resources */}
                <motion.div variants={itemVariants} className="max-w-2xl mx-auto">
                    <div className="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-2xl p-6 border border-purple-200 dark:border-purple-800">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                            Popular Pages You Might Be Looking For
                        </h3>
                        <div className="flex flex-wrap justify-center gap-3">
                            <Link 
                                href="/quote" 
                                className="px-4 py-2 bg-white dark:bg-gray-800 rounded-lg text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 transition-colors"
                            >
                                Get quote
                            </Link>
                            <Link 
                                href="/tracking-shipment" 
                                className="px-4 py-2 bg-white dark:bg-gray-800 rounded-lg text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 transition-colors"
                            >
                                Track Shipment
                            </Link>
                            <Link 
                                href="/about-us" 
                                className="px-4 py-2 bg-white dark:bg-gray-800 rounded-lg text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 transition-colors"
                            >
                                About Us
                            </Link>                        
                        </div>
                    </div>
                </motion.div>

                {/* Technical Message */}
                <motion.div 
                    variants={itemVariants}
                    className="mt-8 text-center"
                >
                    <div className="inline-block p-4 bg-gray-100 dark:bg-gray-800/50 rounded-xl max-w-2xl">
                        <p className="text-sm text-gray-600 dark:text-gray-400">
                            <span className="font-semibold text-gray-900 dark:text-white">Technical Note:</span>{' '}
                            If you believe this page should exist, please check the URL for typos or{' '}
                            <a 
                                href="mailto:support@example.com" 
                                className="text-blue-600 dark:text-blue-400 hover:underline"
                            >
                                contact our support team
                            </a>
                            .
                        </p>
                    </div>
                </motion.div>

                {/* Fun Animation Elements */}
                <div className="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
                    {[...Array(20)].map((_, i) => (
                        <motion.div
                            key={i}
                            className="absolute"
                            style={{
                                left: `${Math.random() * 100}%`,
                                top: `${Math.random() * 100}%`,
                            }}
                            animate={{
                                y: [0, -100, 0],
                                x: [0, Math.random() * 100 - 50, 0],
                                rotate: [0, 360],
                                opacity: [0, 0.5, 0]
                            }}
                            transition={{
                                duration: 5 + Math.random() * 5,
                                delay: Math.random() * 2,
                                repeat: Infinity,
                                ease: "linear"
                            }}
                        >
                            <div className={`text-2xl ${
                                ['❓', '🔍', '🚫', '⚠️', '📍'][Math.floor(Math.random() * 5)]
                            } opacity-30`}></div>
                        </motion.div>
                    ))}
                </div>
            </motion.div>            
        </div>
    );
}