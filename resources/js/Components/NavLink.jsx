import { Link } from '@inertiajs/react';
import React, { useState, useMemo } from 'react';
import { motion } from 'framer-motion';

export default function NavLink({
    active = false,
    className = '',
    children,
    showUnderline = true,
    underlineColor = 'indigo',
    ...props
}) {
    const [isHovered, setIsHovered] = useState(false);
    const [isFocused, setIsFocused] = useState(false);

    // Color mapping for consistent theme
    const colorClasses = useMemo(() => {
        const colors = {
            indigo: {
                active: 'border-indigo-600 dark:border-indigo-500 text-indigo-700 dark:text-indigo-400',
                hover: 'hover:border-indigo-400 dark:hover:border-indigo-400 text-gray-800 dark:text-gray-100',
                default: 'text-gray-600 dark:text-gray-300'
            },
            coral: {
                active: 'border-coral dark:border-coral-500 text-coral dark:text-coral-400',
                hover: 'hover:border-coral dark:hover:border-coral-400 text-gray-800 dark:text-gray-100',
                default: 'text-gray-600 dark:text-gray-300'
            },
            blue: {
                active: 'border-blue-600 dark:border-blue-500 text-blue-700 dark:text-blue-400',
                hover: 'hover:border-blue-400 dark:hover:border-blue-400 text-gray-800 dark:text-gray-100',
                default: 'text-gray-600 dark:text-gray-300'
            }
        };
        
        return colors[underlineColor] || colors.indigo;
    }, [underlineColor]);

    // Base classes
    const baseClasses = useMemo(() => {
        return `
            inline-flex items-center py-1 px-2 
            frank-bold text-sm tracking-wide capitalize 
            leading-5 transition-all duration-200 ease-out
            focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-${underlineColor}-500 dark:focus:ring-${underlineColor}-400
            ${showUnderline ? 'border-b-2' : ''}
        `.replace(/\s+/g, ' ').trim();
    }, [underlineColor, showUnderline]);

    // Dynamic classes based on state
    const dynamicClasses = useMemo(() => {
        if (active) {
            return `
                ${colorClasses.active}
                font-semibold
            `;
        }
        
        if (isHovered || isFocused) {
            return `
                ${colorClasses.hover}
                ${showUnderline ? `border-${underlineColor}-400 dark:border-${underlineColor}-400` : ''}
                transition-colors duration-150
            `;
        }
        
        return `
            ${colorClasses.default}
            ${showUnderline ? 'border-transparent' : ''}
        `;
    }, [active, isHovered, isFocused, colorClasses, showUnderline, underlineColor]);

    // Underline animation for active state
    const underlineAnimation = {
        initial: { scaleX: 0 },
        animate: { scaleX: 1 },
        exit: { scaleX: 0 },
        transition: { duration: 0.3, ease: "easeOut" }
    };

    return (
        <Link
            {...props}
            className={`
                ${baseClasses}
                ${dynamicClasses}
                ${className}
                relative
            `.replace(/\s+/g, ' ').trim()}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            onFocus={() => setIsFocused(true)}
            onBlur={() => setIsFocused(false)}
            aria-current={active ? 'page' : undefined}
        >
            <span className="relative z-10">
                {children}
            </span>
            
            {/* Animated underline for active state */}
            {active && showUnderline && (
                <motion.div
                    className="absolute -bottom-0.5 left-0 right-0 h-0.5 bg-indigo-600 dark:bg-indigo-500 origin-left"
                    initial="initial"
                    animate="animate"
                    variants={underlineAnimation}
                    aria-hidden="true"
                />
            )}
            
            {/* Hover effect - subtle background */}
            {(isHovered || isFocused) && !active && (
                <motion.div
                    className="absolute inset-0 bg-gray-100 dark:bg-gray-800/30 rounded-lg -z-10"
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    transition={{ duration: 0.15 }}
                    aria-hidden="true"
                />
            )}
        </Link>
    );
}

// Optional: Add prop types for better development experience
NavLink.defaultProps = {
    active: false,
    className: '',
    showUnderline: true,
    underlineColor: 'indigo'
};