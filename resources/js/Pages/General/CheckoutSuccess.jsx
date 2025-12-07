import { Head, Link, usePage } from '@inertiajs/react'
import React, { useEffect } from 'react'
import { 
  RiSecurePaymentFill, 
  RiMailCheckFill, 
  RiCalendarCheckFill,
  RiCustomerService2Fill
} from "react-icons/ri";
import { 
  FaArrowLeft, 
  FaCheckCircle, 
  FaFileInvoiceDollar,
  FaBoxOpen,
  FaPhoneAlt,
  FaWhatsapp,
  FaShieldAlt,
  FaStar
} from "react-icons/fa";
import { IoCheckmarkDoneCircle } from "react-icons/io5";
import { motion } from 'framer-motion';
import { toast } from 'react-toastify';

function CheckoutSuccess({ respData }) {
    const page = usePage();
    const { titleMeta } = page.props.titleMeta || { titleMeta: 'Booking Confirmed' };
    const { companyPhone } = page.props.general; 
    // Show success toast on component mount
    useEffect(() => {
        toast.success('Booking confirmed successfully!', {
            position: "top-right",
            autoClose: 5000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: page.props.isDark ? 'dark' : 'light',
        });
        
        // Clear any remaining localStorage items
        localStorage.removeItem('quoteItems');
        localStorage.removeItem('userInfo');
    }, [page.props.isDark]);

    // Animation variants
    const containerVariants = {
        hidden: { opacity: 0 },
        visible: {
            opacity: 1,
            transition: {
                staggerChildren: 0.2,
                delayChildren: 0.1
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
                damping: 20
            }
        }
    };

    return (
        <>
            <Head title={titleMeta}>
                <meta name="robots" content="noindex" />
            </Head>
            
            <section className="min-h-screen py-20 md:py-32 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
                <div className="container mx-auto px-4 md:px-8 lg:px-16 py-8 md:py-12">
                    <motion.div 
                        variants={containerVariants}
                        initial="hidden"
                        animate="visible"
                        className="max-w-4xl mx-auto"
                    >
                        {/* Success Header */}
                        <motion.div 
                            variants={itemVariants}
                            className="text-center mb-8 md:mb-12"
                        >
                            <motion.div
                                variants={iconVariants}
                                className="mb-6 inline-flex items-center justify-center"
                            >
                                <div className="relative">
                                    <div className="absolute inset-0 bg-green-500 rounded-full opacity-20 animate-ping"></div>
                                    <div className="relative p-4 md:p-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full">
                                        <IoCheckmarkDoneCircle className="w-12 h-12 md:w-16 md:h-16 text-white" />
                                    </div>
                                </div>
                            </motion.div>
                            
                            <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                                Booking Confirmed! 🎉
                            </h1>
                            <p className="text-lg md:text-xl text-gray-600 dark:text-gray-300">
                                Thank you, <span className="font-semibold text-green-600 dark:text-green-400">{respData?.username || 'Valued Customer'}</span>
                            </p>
                        </motion.div>

                        {/* Success Card */}
                        <motion.div 
                            variants={itemVariants}
                            className="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-8 md:mb-12"
                        >
                            <div className="p-6 md:p-8 lg:p-10">
                                {/* Reference Number */}
                                <div className="mb-8 text-center">
                                    <div className="inline-flex items-center gap-3 mb-4 mr-3">
                                        <RiSecurePaymentFill className="w-8 h-8 text-green-500" />
                                        <h2 className="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                                            Your Booking Reference
                                        </h2>
                                    </div>
                                    <div className="inline-block px-6 py-3 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700 rounded-xl">
                                        <code className="text-2xl md:text-3xl font-mono font-bold text-green-700 dark:text-green-300 tracking-wider">
                                            {respData?.refNo || 'N/A'}
                                        </code>
                                    </div>
                                    <p className="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                        Keep this number for all future communications
                                    </p>
                                </div>

                                {/* Email Confirmation */}
                                <div className="mb-8">
                                    <div className="flex items-center gap-3 mb-4">
                                        <RiMailCheckFill className="w-7 h-7 text-blue-500" />
                                        <h3 className="text-lg md:text-xl font-semibold text-gray-900 dark:text-white">
                                            Email Confirmation Sent
                                        </h3>
                                    </div>
                                    <div className="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                                        <p className="text-gray-700 dark:text-gray-300">
                                            We've sent a detailed confirmation to{' '}
                                            <span className="font-semibold text-blue-600 dark:text-blue-400">
                                                {respData?.email || 'your email'}
                                            </span>
                                        </p>
                                        <p className="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                            Please check your inbox (and spam folder) for:
                                        </p>
                                        <ul className="mt-2 space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                            <li className="flex items-center gap-2">
                                                <FaCheckCircle className="w-4 h-4 text-green-500" />
                                                <span>Booking confirmation & receipt</span>
                                            </li>
                                            <li className="flex items-center gap-2">
                                                <FaCheckCircle className="w-4 h-4 text-green-500" />
                                                <span>Moving checklist & preparation guide</span>
                                            </li>
                                            <li className="flex items-center gap-2">
                                                <FaCheckCircle className="w-4 h-4 text-green-500" />
                                                <span>Contact details for your move coordinator</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                {/* Next Steps */}
                                <div>
                                    <div className="flex items-center gap-3 mb-6">
                                        <RiCalendarCheckFill className="w-7 h-7 text-purple-500" />
                                        <h3 className="text-lg md:text-xl font-semibold text-gray-900 dark:text-white">
                                            What Happens Next
                                        </h3>
                                    </div>
                                    
                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div className="p-4 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl border border-purple-200 dark:border-purple-800">
                                            <div className="flex items-center gap-3 mb-3">
                                                <div className="p-2 bg-purple-100 dark:bg-purple-800 rounded-lg">
                                                    <FaPhoneAlt className="w-5 h-5 text-purple-600 dark:text-purple-400" />
                                                </div>
                                                <h4 className="font-medium text-gray-900 dark:text-white">Within 24 Hours</h4>
                                            </div>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                Our team will call to confirm all details and answer any questions.
                                            </p>
                                        </div>
                                        
                                        <div className="p-4 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl border border-amber-200 dark:border-amber-800">
                                            <div className="flex items-center gap-3 mb-3">
                                                <div className="p-2 bg-amber-100 dark:bg-amber-800 rounded-lg">
                                                    <FaBoxOpen className="w-5 h-5 text-amber-600 dark:text-amber-400" />
                                                </div>
                                                <h4 className="font-medium text-gray-900 dark:text-white">Before Moving Day</h4>
                                            </div>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                You'll receive a comprehensive moving guide and packing checklist.
                                            </p>
                                        </div>
                                        
                                        <div className="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                                            <div className="flex items-center gap-3 mb-3">
                                                <div className="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                                                    <FaFileInvoiceDollar className="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                                </div>
                                                <h4 className="font-medium text-gray-900 dark:text-white">Moving Day</h4>
                                            </div>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                Our team will arrive at the scheduled time with all necessary equipment.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </motion.div>

                        {/* Action Buttons & Support */}
                        <motion.div 
                            variants={itemVariants}
                            className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8"
                        >
                            {/* Primary Actions */}
                            <div className="space-y-4">
                                <Link 
                                    href="/"
                                    className="group block w-full p-6 bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-blue-500 transition-all duration-300"
                                >
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-4">
                                            <div className="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg group-hover:scale-110 transition-transform">
                                                <FaArrowLeft className="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                                            </div>
                                            <div className="text-left">
                                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Return Home
                                                </h3>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    Back to homepage
                                                </p>
                                            </div>
                                        </div>
                                        <div className="text-indigo-600 dark:text-indigo-400 group-hover:translate-x-2 transition-transform">
                                            →
                                        </div>
                                    </div>
                                </Link>

                                <Link 
                                    href={route('tracker')}
                                    className="group block w-full p-6 bg-gradient-to-r from-indigo-500 to-purple-500 dark:from-blue-600 dark:to-purple-600 rounded-xl hover:shadow-xl transition-all duration-300"
                                >
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-4">
                                            <div className="p-3 bg-white/20 rounded-lg backdrop-blur-sm group-hover:scale-110 transition-transform">
                                                <FaStar className="w-6 h-6 text-white" />
                                            </div>
                                            <div className="text-left">
                                                <h3 className="text-lg font-semibold text-white">
                                                    Track Your Booking
                                                </h3>
                                                <p className="text-sm text-white/80">
                                                    Real-time updates & status
                                                </p>
                                            </div>
                                        </div>
                                        <div className="text-white group-hover:translate-x-2 transition-transform">
                                            →
                                        </div>
                                    </div>
                                </Link>
                            </div>

                            {/* Support Options */}
                            <div className="space-y-4">
                                <div className="p-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800">
                                    <div className="flex items-center gap-3 mb-4">
                                        <RiCustomerService2Fill className="w-7 h-7 text-green-600 dark:text-green-400" />
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                            Need Help?
                                        </h3>
                                    </div>
                                    
                                    <div className="space-y-3">
                                        <a 
                                            href={`https://wa.me/${companyPhone}?text=Hi! I need help with booking ${respData?.refNo}`}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/30 transition-colors group"
                                        >
                                            <div className="flex items-center gap-3">
                                                <div className="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                                                    <FaWhatsapp className="w-5 h-5 text-green-600 dark:text-green-400" />
                                                </div>
                                                <span className="font-medium text-gray-900 dark:text-white">
                                                    Chat on WhatsApp
                                                </span>
                                            </div>
                                            <span className="text-sm text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-400">
                                                Instant response
                                            </span>
                                        </a>
                                        
                                        <div className="p-3 bg-white dark:bg-gray-800 rounded-lg">
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                Or call us at{' '}
                                                <a 
                                                    href={"tel:"+ companyPhone}
                                                    className="font-semibold text-blue-600 dark:text-blue-400 hover:underline"
                                                >
                                                   {companyPhone}
                                                </a>
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Monday - Friday, 8am - 8pm
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </motion.div>

                        {/* Security & Trust */}
                        <motion.div 
                            variants={itemVariants}
                            className="text-center"
                        >
                            <div className="inline-flex flex-wrap justify-center gap-6 mb-6">
                                <div className="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <FaShieldAlt className="w-4 h-4 text-green-500" />
                                    <span>100% Secure Payment</span>
                                </div>
                                <div className="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <FaCheckCircle className="w-4 h-4 text-green-500" />
                                    <span>Money-Back Guarantee</span>
                                </div>
                                <div className="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <FaStar className="w-4 h-4 text-amber-500" />
                                    <span>Rated 4.8/5 by Customers</span>
                                </div>
                            </div>
                            
                            <div className="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl max-w-2xl mx-auto">
                                <p className="text-sm text-gray-600 dark:text-gray-300">
                                    <span className="font-semibold text-gray-900 dark:text-white">Important:</span>{' '}
                                    Please keep your booking reference number safe. You'll need it for any future communications or modifications to your booking.
                                </p>
                            </div>
                        </motion.div>
                    </motion.div>
                </div>

                {/* Confetti Animation Container */}
                <div className="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
                    {[...Array(50)].map((_, i) => (
                        <motion.div
                            key={i}
                            className="absolute w-2 h-2 rounded-full"
                            style={{
                                backgroundColor: ['#10b981', '#3b82f6', '#8b5cf6', '#f59e0b'][Math.floor(Math.random() * 4)],
                                left: `${Math.random() * 100}%`,
                                top: '-10px',
                            }}
                            initial={{ y: -100, opacity: 0, rotate: 0 }}
                            animate={{ 
                                y: window.innerHeight + 100,
                                opacity: [0, 1, 1, 0],
                                rotate: 360,
                                x: Math.random() * 100 - 50
                            }}
                            transition={{
                                duration: 3 + Math.random() * 2,
                                delay: Math.random() * 1.5,
                                ease: "easeOut"
                            }}
                        />
                    ))}
                </div>
            </section>
        </>
    );
}

export default CheckoutSuccess;