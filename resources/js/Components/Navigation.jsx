import React, { useState, useEffect, useCallback } from 'react';
import { useAppContext } from '../Contexts/GeneralContextProvider';
import { Link } from '@inertiajs/react';
import ApplicationLogo from './ApplicationLogo';
import NavLink from './NavLink';
import ResponsiveNavLink from './ResponsiveNavLink';
import { MdAlternateEmail } from "react-icons/md";
import { SlCallIn } from "react-icons/sl";
import { CgMenuLeft } from "react-icons/cg";
import { RiCloseLargeLine } from "react-icons/ri";
import { motion, AnimatePresence } from "framer-motion"
import ThemeToggler from './ThemeToggler';

// Animation variants
const backdropVariants = {
  open: {
    opacity: 1,
    transition: {
      duration: 0.3,
    }
  },
  closed: {
    opacity: 0,
    transition: {
      duration: 0.2,
    }
  }
};

const mobileMenuVariants = {
  open: {
    x: 0,
    opacity: 1,
    transition: {
      duration: 0.3,
      ease: "easeOut",
      when: "beforeChildren",
    },
  },
  closed: {
    x: '-100%',
    opacity: 0,
    transition: {
      duration: 0.2,
      ease: "easeIn",
      when: "afterChildren",
    },
  },
};

const menuItemVariants = {
  open: { 
    x: 0, 
    opacity: 1,
    transition: {
      duration: 0.2,
      ease: "easeOut"
    }
  },
  closed: { 
    x: -20, 
    opacity: 0,
    transition: {
      duration: 0.15,
      ease: "easeIn"
    }
  },
};

const menuContainerVariants = {
  open: {
    transition: {
      staggerChildren: 0.05,
      delayChildren: 0.1,
    },
  },
  closed: {
    transition: {
      staggerChildren: 0.02,
      staggerDirection: -1,
    },
  },
};

const Navbar = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const { companyPhone, replyToAddress } = useAppContext();
  const [isScrolled, setIsScrolled] = useState(false);

  // Handle scroll effect
  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 10);
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    
    // Initial check
    handleScroll();
    
    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []);

  // Handle escape key to close menu
  useEffect(() => {
    const handleEscapeKey = (event) => {
      if (event.key === 'Escape' && isMenuOpen) {
        setIsMenuOpen(false);
      }
    };

    document.addEventListener('keydown', handleEscapeKey);
    
    // Prevent body scroll when menu is open
    if (isMenuOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }

    return () => {
      document.removeEventListener('keydown', handleEscapeKey);
      document.body.style.overflow = '';
    };
  }, [isMenuOpen]);

  // Navigation menu items
  const menuItems = [
    { 
      label: 'About us', 
      href: route('about'), 
      isActive: route().current('about') 
    },
    { 
      label: 'Track shipment', 
      href: route('tracker'), 
      isActive: route().current('tracker') 
    },
    { 
      label: 'Get a quote', 
      href: route('quote'), 
      isActive: route().current('quote') 
    },
    { 
      label: 'Contact us', 
      href: route('contact'), 
      isActive: route().current('contact') 
    },
  ];

  // Handle click outside mobile menu
  const handleBackdropClick = useCallback((e) => {
    if (e.target === e.currentTarget) {
      setIsMenuOpen(false);
    }
  }, []);

  return (
    <>
      <nav 
        className={`fixed top-0 left-0 right-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm transition-all duration-300 ${
          isScrolled 
            ? 'shadow-lg dark:shadow-gray-900/20 py-2' 
            : 'border-b border-gray-100 dark:border-gray-800 py-3'
        } z-40 px-4 sm:px-6 lg:px-8`} 
        role="navigation"
        aria-label="Main navigation"
      >
        <div className="max-w-7xl mx-auto">
          <div className="flex justify-between items-center h-14 lg:h-16">
            {/* Logo */}
            <div className="flex items-center">
              <Link 
                href={route('guest_home')} 
                aria-label="Go to homepage"
                className="focus:outline-none focus:ring-2 focus:ring-coral dark:focus:ring-blue-500 focus:ring-offset-2 rounded-lg transition-all"
              >
                <ApplicationLogo classList="h-20 w-36 lg:h-24 lg:w-40" />
              </Link>
            </div>

            {/* Desktop Navigation Links */}
            <div className="hidden lg:flex items-center space-x-4">
              {menuItems.map((item, index) => (
                <NavLink 
                  key={index}
                  href={item.href} 
                  active={item.isActive}
                  className="px-4 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200"
                >
                  {item.label}
                </NavLink>
              ))}
            </div>

            {/* Desktop Contact Info & Theme Toggler */}
            <div className="hidden lg:flex items-center gap-4">
              <a 
                href={`mailto:${replyToAddress}`}
                className="inline-flex items-center gap-1.5 hover:underline text-coral dark:text-blue-500 px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                aria-label={`Send email to ${replyToAddress}`}
              >
                <MdAlternateEmail className="size-4" />
                <span className="font-medium text-sm">{replyToAddress}</span>
              </a>
              
              <a 
                href={`tel:${companyPhone.replace(/\s/g, '')}`}
                className="inline-flex items-center gap-1.5 hover:underline text-coral dark:text-blue-500 px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                aria-label={`Call ${companyPhone}`}
              >
                <SlCallIn className="size-4" />
                <span className="font-medium text-sm">{companyPhone}</span>
              </a>
              
              <div className="pl-2 border-l border-gray-200 dark:border-gray-700">
                <ThemeToggler />
              </div>
            </div>

            {/* Mobile Menu Button */}
            <div className="flex items-center gap-2 lg:hidden">
              <ThemeToggler className="mr-4" />
              <button
                onClick={() => setIsMenuOpen(!isMenuOpen)}
                aria-label={isMenuOpen ? "Close navigation menu" : "Open navigation menu"}
                aria-expanded={isMenuOpen}
                className="inline-flex items-center text-gray-700 dark:text-gray-300 hover:text-coral dark:hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-coral dark:focus:ring-blue-500 focus:ring-offset-2 rounded-lg px-3 py-2 transition-colors"
              >
                <span className="text-sm font-medium mr-2">
                  {isMenuOpen ? 'Close' : 'Menu'}
                </span>
                {isMenuOpen ? (
                  <RiCloseLargeLine size={24} />
                ) : (
                  <CgMenuLeft size={24} />
                )}
              </button>
            </div>
          </div>
        </div>
      </nav>

      {/* Mobile Navigation Menu */}
      <AnimatePresence>
        {isMenuOpen && (
          <div className="lg:hidden fixed inset-0 z-50">
            {/* Backdrop */}
            <motion.div
              className="absolute inset-0 bg-black/40 dark:bg-black/60"
              variants={backdropVariants}
              initial="closed"
              animate="open"
              exit="closed"
              onClick={handleBackdropClick}
              aria-hidden="true"
            />
            
            {/* Mobile Menu Panel */}
            <motion.div
              className="absolute top-0 left-0 h-full w-full max-w-sm bg-white dark:bg-gray-900 shadow-xl"
              variants={mobileMenuVariants}
              initial="closed"
              animate="open"
              exit="closed"
              role="dialog"
              aria-modal="true"
              aria-label="Mobile navigation menu"
            >
              <div className="h-full flex flex-col p-6">
                {/* Menu Header */}
                <div className="flex justify-between items-center pb-6 border-b border-gray-200 dark:border-gray-700">
                  <Link 
                    href={route('guest_home')} 
                    onClick={() => setIsMenuOpen(false)}
                    aria-label="Go to homepage"
                    className="focus:outline-none focus:ring-2 focus:ring-coral dark:focus:ring-blue-500 rounded-lg"
                  >
                    <ApplicationLogo classList="h-7 w-32" />
                  </Link>
                  <button
                    onClick={() => setIsMenuOpen(false)}
                    className="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-coral dark:focus:ring-blue-500 transition-colors"
                    aria-label="Close menu"
                  >
                    <RiCloseLargeLine size={24} />
                  </button>
                </div>

                {/* Navigation Links */}
                <motion.div 
                  className="flex-grow py-8"
                  variants={menuContainerVariants}
                  initial="closed"
                  animate="open"
                  exit="closed"
                >
                  {menuItems.map((item, index) => (
                    <motion.div
                      key={index}
                      variants={menuItemVariants}
                      className="mb-1"
                    >
                      <ResponsiveNavLink
                        href={item.href}
                        active={item.isActive}
                        onClick={() => setIsMenuOpen(false)}
                        className="px-4 py-3 rounded-lg text-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors flex items-center group"
                      >
                        <span className="mr-3 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                        {item.label}
                      </ResponsiveNavLink>
                    </motion.div>
                  ))}
                </motion.div>

                {/* Contact Information */}
                <div className="pt-6 mt-auto border-t border-gray-200 dark:border-gray-700">
                  <h4 className="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Get in touch
                  </h4>
                  
                  <div className="space-y-4 pl-2">
                    <a
                      href={`mailto:${replyToAddress}`}
                      onClick={() => setIsMenuOpen(false)}
                      className="flex items-center text-coral dark:text-blue-500 hover:underline group"
                      aria-label={`Send email to ${replyToAddress}`}
                    >
                      <div className="p-2 mr-3 rounded-lg bg-gray-50 dark:bg-gray-800 group-hover:bg-gray-100 dark:group-hover:bg-gray-700 transition-colors">
                        <MdAlternateEmail className="size-5" />
                      </div>
                      <span className="font-medium">{replyToAddress}</span>
                    </a>
                    
                    <a
                      href={`tel:${companyPhone.replace(/\s/g, '')}`}
                      onClick={() => setIsMenuOpen(false)}
                      className="flex items-center text-coral dark:text-blue-500 hover:underline group"
                      aria-label={`Call ${companyPhone}`}
                    >
                      <div className="p-2 mr-3 rounded-lg bg-gray-50 dark:bg-gray-800 group-hover:bg-gray-100 dark:group-hover:bg-gray-700 transition-colors">
                        <SlCallIn className="size-5" />
                      </div>
                      <span className="font-medium">{companyPhone}</span>
                    </a>
                  </div>
                </div>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
      
      {/* Add padding to prevent content from hiding behind fixed navbar */}
      <div className="h-16 lg:h-20" />
    </>
  );
};

export default Navbar;