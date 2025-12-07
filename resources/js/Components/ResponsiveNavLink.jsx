import { Link } from '@inertiajs/react';
import React from 'react';

const ResponsiveNavLink = ({ href, active, children }) => {
    return (
        <Link
            href={href}
            className={`block w-full pl-3 py-2 border-l-4 text-sm uppercase font-semibold ${
                active
                    ? 'border-indigo-600 dark:border-blue-500 text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800'
                    : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 dark:hover:border-gray-700'
            }`}
        >
            {children}
        </Link>
    );
};

export default ResponsiveNavLink;
