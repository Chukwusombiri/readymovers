import React, { useState } from 'react'
import { FaArrowRightLong } from 'react-icons/fa6'
import { Link } from '@inertiajs/react'
import SectionHeading from './SectionHeading'
import Section from './Section'
function Cta() {
    const [postCode, setPostCode] = useState('');
    return (
        <Section>
            <div className="mx-6 max-w-6xl mx-auto rounded-xl p-6 lg:p-14 bg-indigo-100 dark:bg-blue-200">
                <div className="grid grid-cols-1 md:grid-cols-2 items-center gap-6 md:gap-8">
                    <div className="flex flex-col gap-4">
                        <SectionHeading title={'Are you ready to move?'} className={'capitolium text-gray-800 font-bold'}/>
                        <p className="text-sm text-gray-700 max-w-sm">You are just a button click away from making a hassle-free move into your new home.</p>
                    </div>
                    <div>
                        <div className="flex flex-wrap justify-center">
                            <input onChange={(e) => setPostCode(e.target.value)} type="text" name="postcode" id="postcode" placeholder='Your Post code ...' className='w-full lg:w-3/5 p-3 rounded-xl bg-inherit text-gray-800 text-md placeholder:text-gray-600 placeholder:uppercase border-gray-400 focus:border-indigo-500 dark:focus:border-blue-400' />
                            <Link href={postCode.trim() ? `${route('quote.move')}?postCode=${postCode}` : route('quote.move')} className='lg:w-2/5 pt-4 lg:pl-3 lg:pt-0 hover:opacity-80 flex'>
                                <span className='w-full flex justify-center gap-2 items-center rounded-lg bg-indigo-700 dark:bg-blue-600 text-white text-xs font-semibold px-6 py-3 lg:px-6 lg:py-4 lg:text-sm uppercase tracking-widest'>
                                    Get quote
                                    <FaArrowRightLong />
                                </span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Section>
    )
}

export default Cta