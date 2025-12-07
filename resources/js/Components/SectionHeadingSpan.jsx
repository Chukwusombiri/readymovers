import React from 'react'
import clsx from "clsx";
export default function SectionHeadingSpan({title, className}) {
    const classes = clsx('tracking-wide mb-4 uppercase frank-bold', 
        className || 'text-coral dark:text-orange-500 text-sm'
    )
  return (
    <h5 className={classes}>{title}</h5>
  )
}
