import React from 'react'
import clsx from 'clsx'

export default function SectionHeading({title, className}) {
    const classes = clsx('text-3xl lg:text-4xl', className || 'text-gray-700 dark:text-gray-200 frank-bold')
  return (
    <h2 className={classes}>{title}</h2>
  )
}
