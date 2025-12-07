import React from 'react'
import clsx from "clsx"

export default function PrimaryButton({className, children, ...props}) {
    const classes = clsx('rounded-xl bg-indigo-700 dark:bg-blue-700 hover:bg-indigo-800 dark:hover:bg-blue-800 px-6 py-2 md:px-10 py-4 text-xs text-gray-100 font-semibold tracking-wide uppercase inline-flex gap-2 items-center justify-center hover:gap-4', className || '');
  return (
    <button
    {...props}
    className={classes} >{children}</button>
  )
}