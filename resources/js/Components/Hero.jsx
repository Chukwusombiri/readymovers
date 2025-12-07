import { Link } from '@inertiajs/react'
import React, { useState } from 'react'
import { CiCircleCheck } from "react-icons/ci";
import { FaArrowRightLong } from "react-icons/fa6";
import { IoIosArrowRoundForward } from "react-icons/io";
function Hero() {
    const [postCode, setPostCode] = useState('');
    const inlineStyle = {
        backgroundImage: `url('/images/landing/hero1.jpg')`
    }
    return (
        <section className='bg-white dark:bg-gray-900'>
            <div className="w-full max-w-6xl mx-auto frank-regular grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div className="relative flex">
                    <div className="absolute lg:hidden inset-0 bg-cover bg-center flex" style={inlineStyle}>
                        <div className="w-full h-full bg-gray-900/50 backdrop-blur-[1.5px]"></div>
                    </div>

                    <div className="mx-auto relative z-20 w-full px-6 pt-32 pb-10 flex flex-col items-center lg:items-start">
                        <h1 className="w-full text-center lg:text-start text-4xl capitolium font-bold md:text-5xl lg:text-6xl text-gray-100 lg:text-gray-800 dark:lg:text-gray-200 tracking-wider">
                            Let's Simplify Your
                            <span className="ml-2 text-gray-100 lg:text-blue-500">Next Move</span>
                        </h1>
                        <p className="mt-6 max-w-md text-lg tracking-wider text-gray-50 lg:text-gray-900 dark:lg:text-gray-100 text-center lg:text-start">
                            Driving Excellence, Delivering Success: Your Trusted Partner in Logistics Solutions
                        </p>
                        <div className="lg:w-full mt-8 bg-indigo-100 dark:bg-blue-100 rounded-xl p-6 lg:p-8">
                            <p className="text-lg text-gray-800 font-semibold tracking-wide mb-4">
                                Quickly move houses with just a click of button. Enter pick-up postcode for instant quote.
                            </p>
                            <div className="flex flex-wrap justify-center ">
                                <input value={postCode} onChange={(e) => setPostCode(e.target.value)} type="text" name="postcode" id="postcode" placeholder='Your Post code ...' className='w-full lg:w-3/5 p-3 rounded-xl bg-inherit text-gray-800 text-md placeholder:text-gray-600 placeholder:uppercase border-gray-400 focus:border-indigo-500 dark:focus:border-blue-400' />
                                <Link href={postCode ? `${route('quote.move')}?postCode=${postCode}` : route('quote.move')} className='lg:w-2/5 pt-4 lg:pl-3 lg:pt-0 hover:opacity-80 flex'>
                                    <span className='w-full flex justify-center gap-2 items-center rounded-lg bg-indigo-700 dark:bg-blue-600 text-white text-xs font-semibold px-6 py-3 lg:px-6 lg:py-4 lg:text-sm uppercase tracking-widest'>
                                        Get quote
                                        <FaArrowRightLong />
                                    </span>
                                </Link>
                            </div>
                        </div>
                        <p className="mt-4 flex justify-center lg:justify-start items-center gap-2">
                            <CiCircleCheck className='size-5 dark:text-green-500 text-green-600 lg:text-green-600' />
                            <span className='text-sm text-gray-50 lg:text-gray-800 dark:lg:text-gray-50'>Move tracking just got a lot easier.</span>
                            <Link href='/tracker' className='text-gray-50 lg:text-coral dark:lg:text-orange-500 border-b border-gray-50 lg:border-0 pb-0.5 hover:opacity-90 tracking-wide text-sm flex items-center gap-1'>Track now<IoIosArrowRoundForward className='size-6' /></Link>
                        </p>
                    </div>
                </div>
                <div className="hidden lg:px-10 lg:flex h-[46vh] lg:h-[70vh] mt-32">
                    <img src="/images/landing/hero1.jpg" alt="hero photo" className='w-full h-full rounded-xl' />
                </div>
            </div>
        </section>
    )
}

export default Hero