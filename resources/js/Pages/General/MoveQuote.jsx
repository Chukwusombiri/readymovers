import { Head, usePage } from '@inertiajs/react'
import React, { useEffect, useState, useCallback } from 'react'
import QuoteGeo from '../../Components/QuoteGeo';
import QuoteItems from '../../Components/QuoteItems';
import QuoteUserInfo from '../../Components/QuoteUserInfo';
import Summary from '../../Components/Summary';
import { ToastContainer, toast } from 'react-toastify';
import { useAppContext } from '../../Contexts/GeneralContextProvider';
import { motion, AnimatePresence } from 'framer-motion';
import { FaTruckMoving, FaBoxOpen, FaUserCircle, FaCheckCircle } from 'react-icons/fa';
import { IoChevronForward } from 'react-icons/io5';

export default function MoveQuote({ respData }) {
  const page = usePage();
  const { titleMeta } = page.props.titleMeta || { titleMeta: 'Get a Moving Quote' };
  const [step, setStep] = useState(1);
  const [isComplete, setIsComplete] = useState(false);
  const [summaryKey, setSummaryKey] = useState(1);
  const [isTransitioning, setIsTransitioning] = useState(false);
  const { isDark } = useAppContext();

  const stepsHeading = [
    {
      step: 1,
      heading: 'Where and when would you like to move?',
      description: 'Start by telling us about your moving locations and schedule',
      icon: <FaTruckMoving className="w-5 h-5" />
    },
    {
      step: 2,
      heading: 'What items are you moving?',
      description: 'Select the furniture and items you need to transport',
      icon: <FaBoxOpen className="w-5 h-5" />
    },
    {
      step: 3,
      heading: 'Your Contact Information',
      description: 'Final step! Tell us how we can reach you',
      icon: <FaUserCircle className="w-5 h-5" />
    }
  ];

  const handleStepChange = useCallback((newStep) => {
    setIsTransitioning(true);
    setTimeout(() => {
      setStep(newStep);
      setIsTransitioning(false);
      // Scroll to top on step change
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 300);
  }, []);

  const handleComplete = useCallback(() => {
    setIsTransitioning(true);
    setTimeout(() => {
      setIsComplete(true);
      setIsTransitioning(false);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 300);
  }, []);

  useEffect(() => {
    if (respData?.status === 'error') {
      toast.error('Oops! Something went wrong with your booking. Please try again.', {
        position: "top-right",
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
      });
    }
  }, [respData]);

  return (
    <>
      <Head title={titleMeta} />
      <ToastContainer
        theme={isDark ? 'dark' : 'light'}
        position="top-right"
        autoClose={5000}
        hideProgressBar={false}
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
        className="z-50"
      />

      <motion.section
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ duration: 0.5 }}
        className="pt-20 lg:pt-28 pb-20 min-h-screen bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800"
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Progress Header */}
          <motion.div
            initial={{ y: -20, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.2 }}
            className="mb-8 lg:mb-12"
          >
            <div className="text-center mb-6">
              <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">
                Get Your Moving Quote
              </h1>
              <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Quick, accurate, and transparent pricing for your move
              </p>
            </div>

            {/* Desktop Progress Steps */}
            <div className="hidden lg:block max-w-3xl mx-auto mb-10">
              <div className="flex items-center justify-between">
                {stepsHeading.map((item, index) => (
                  <React.Fragment key={item.step}>
                    <div className="flex flex-col items-center relative z-10">
                      <motion.div
                        whileHover={{ scale: 1.05 }}
                        whileTap={{ scale: 0.95 }}
                        className={`w-16 h-16 rounded-full flex items-center justify-center border-4 transition-all duration-300 ${step >= item.step
                            ? 'border-blue-500 dark:border-blue-400 bg-blue-500 dark:bg-blue-400 text-white'
                            : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-400 dark:text-gray-500'
                          } ${step === item.step ? 'ring-4 ring-blue-200 dark:ring-blue-900' : ''}`}
                      >
                        {step > item.step ? (
                          <FaCheckCircle className="w-6 h-6" />
                        ) : (
                          <span className="text-lg font-bold">{item.step}</span>
                        )}
                      </motion.div>
                      <div className="mt-3 text-center">
                        <h3 className={`text-sm font-semibold ${step >= item.step
                            ? 'text-gray-900 dark:text-white'
                            : 'text-gray-500 dark:text-gray-400'
                          }`}>
                          {item.heading.split(' ')[0]} {item.heading.split(' ')[1]}
                        </h3>
                        <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                          Step {item.step}
                        </p>
                      </div>
                    </div>

                    {index < stepsHeading.length - 1 && (
                      <div className="flex-1 mx-4 relative">
                        <div className="absolute inset-0 flex items-center">
                          <div className="w-full h-1 bg-gray-200 dark:bg-gray-700"></div>
                          <motion.div
                            initial={{ width: step > item.step ? '100%' : '0%' }}
                            animate={{ width: step > item.step ? '100%' : '0%' }}
                            transition={{ duration: 0.5 }}
                            className="absolute h-1 bg-blue-500 dark:bg-blue-400"
                          ></motion.div>
                        </div>
                      </div>
                    )}
                  </React.Fragment>
                ))}
              </div>
            </div>

            {/* Mobile Progress Steps */}
            <div className="lg:hidden mb-8">
              <div className="flex items-center justify-between mb-4">
                {stepsHeading.map((item) => (
                  <motion.div
                    key={item.step}
                    className={`flex items-center ${step === item.step ? 'scale-110' : ''}`}
                    animate={{ scale: step === item.step ? 1.1 : 1 }}
                    transition={{ duration: 0.3 }}
                  >
                    <div className={`w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all ${step >= item.step
                        ? 'border-blue-500 dark:border-blue-400 bg-blue-500 dark:bg-blue-400 text-white'
                        : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-400'
                      }`}>
                      {step > item.step ? (
                        <FaCheckCircle className="w-4 h-4" />
                      ) : (
                        <span className="text-sm font-bold">{item.step}</span>
                      )}
                    </div>
                    {item.step < 3 && (
                      <IoChevronForward className={`mx-1 transition-colors ${step > item.step ? 'text-blue-500 dark:text-blue-400' : 'text-gray-300 dark:text-gray-600'
                        }`} />
                    )}
                  </motion.div>
                ))}
              </div>

              <AnimatePresence mode="wait">
                <motion.div
                  key={step}
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: -10 }}
                  transition={{ duration: 0.3 }}
                  className="text-center"
                >
                  <h2 className="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {stepsHeading[step - 1].heading}
                  </h2>
                  <p className="text-gray-600 dark:text-gray-300 text-sm">
                    {stepsHeading[step - 1].description}
                  </p>
                </motion.div>
              </AnimatePresence>
            </div>
          </motion.div>

          {/* Main Content */}
          <div className="relative">
            {/* Loading Overlay */}
            <AnimatePresence>
              {isTransitioning && (
                <motion.div
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                  exit={{ opacity: 0 }}
                  className="absolute inset-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm z-20 flex items-center justify-center rounded-2xl"
                >
                  <div className="flex flex-col items-center">
                    <div className="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                    <p className="text-gray-600 dark:text-gray-300">Loading...</p>
                  </div>
                </motion.div>
              )}
            </AnimatePresence>

            {/* Content Area */}
            <AnimatePresence mode="wait">
              {isComplete ? (
                <motion.div
                  key="summary"
                  initial={{ opacity: 0, scale: 0.95 }}
                  animate={{ opacity: 1, scale: 1 }}
                  exit={{ opacity: 0, scale: 0.95 }}
                  transition={{ duration: 0.4 }}
                >
                  <Summary
                    key={summaryKey}
                    reset={() => setSummaryKey(prev => prev + 1)}
                    prev={() => setIsComplete(false)}
                    restart={() => {
                      setIsComplete(false);
                      setStep(1);
                    }}
                  />
                </motion.div>
              ) : (
                <motion.div
                  key={`step-${step}`}
                  initial={{ opacity: 0, x: step > 1 ? 20 : -20 }}
                  animate={{ opacity: 1, x: 0 }}
                  exit={{ opacity: 0, x: step > 1 ? -20 : 20 }}
                  transition={{ duration: 0.3 }}
                  className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden"
                >
                  {/* Step Content */}
                  <div className="p-6 md:p-8">
                    {step === 1 && (
                      <QuoteGeo
                        next={() => handleStepChange(2)}
                        postCode={respData?.postCode}
                      />
                    )}
                    {step === 2 && (
                      <QuoteItems
                        next={() => handleStepChange(3)}
                        prev={() => handleStepChange(1)}
                        allItems={respData?.allItems}
                      />
                    )}
                    {step === 3 && (
                      <QuoteUserInfo
                        prev={() => handleStepChange(2)}
                        next={handleComplete}
                      />
                    )}
                  </div>                  
                </motion.div>
              )}
            </AnimatePresence>
          </div>

          {/* Help Section */}
          {!isComplete && (
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.6 }}
              className="mt-8 text-center"
            >
              <div className="inline-flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <div className="flex items-center gap-2">
                  <div className="w-2 h-2 rounded-full bg-green-500"></div>
                  <span>Quick quote</span>
                </div>
                <div className="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                <div className="flex items-center gap-2">
                  <div className="w-2 h-2 rounded-full bg-blue-500"></div>
                  <span>No commitment</span>
                </div>
                <div className="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                <div className="flex items-center gap-2">
                  <div className="w-2 h-2 rounded-full bg-purple-500"></div>
                  <span>24/7 support</span>
                </div>
              </div>
            </motion.div>
          )}
        </div>
      </motion.section>

      {/* Floating Help Button */}
      <motion.button
        initial={{ opacity: 0, scale: 0 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ delay: 1 }}
        whileHover={{ scale: 1.1 }}
        whileTap={{ scale: 0.9 }}
        className="fixed bottom-6 right-6 w-12 h-12 bg-blue-500 dark:bg-blue-400 text-white rounded-full shadow-lg flex items-center justify-center z-40 hover:shadow-xl transition-shadow"
        onClick={() => toast.info('Need help? Call us at 1-800-MOVE-NOW')}
      >
        <span className="text-lg font-bold">?</span>
      </motion.button>
    </>
  )
}