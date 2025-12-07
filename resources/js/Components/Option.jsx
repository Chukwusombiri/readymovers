import React from 'react'

export default function Option({val='',placeholder}) {
  return (
    <option value={val} className='bg-gray-50 dark:bg-gray-800 text-sm  text-gray-800 dark:text-gray-200'>{placeholder}</option>
  )
}
