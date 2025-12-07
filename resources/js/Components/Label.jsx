import React from 'react'

export default function Label({val, ...props}) {
  return (
    <label {...props} className='text-sm capitalize font-medium dark:text-gray-400 text-gray-600'>{val}</label>
  )
}
