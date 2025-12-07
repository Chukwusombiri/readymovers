import React from 'react'

export default function Select({children, ...props}) {
    return (
        <select {...props} className="text-sm text-gray-800 dark:text-gray-200 bg-inherit px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-indigo-700 dark:focus:border-blue-600">
            {children}
        </select>
    )
}
