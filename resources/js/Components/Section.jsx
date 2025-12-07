import clsx from 'clsx';
import React from 'react'

export default function Section({ className, children, ...props}) {
    const classes = clsx('bg-white dark:bg-gray-900 pt-14 pb-24', className || '');
    return (
        <section className={classes} {...props}>{children}</section>
    )
}
