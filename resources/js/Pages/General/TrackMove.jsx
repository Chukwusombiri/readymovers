import React from 'react'
import Tracker from '../../Components/Tracker'
import { FaHeadphonesAlt } from "react-icons/fa";
import { BsUiChecks } from "react-icons/bs";
import { IoReceiptOutline } from "react-icons/io5";
import { FaArrowRightLong } from 'react-icons/fa6';
import { useAppContext } from '../../Contexts/GeneralContextProvider';
import { BsCheck2Circle } from "react-icons/bs";

export default function TrackMove() {
    const {isDark} = useAppContext();
    const imgSrc = isDark ? 'images/tracker/hero.jpg' : 'images/tracker/vector-move-light.avif';    
    return (
        <div className='max-w-6xl mx-auto px-6'>
            <section className="pt-24 lg:pt-32 pb-20">
                <div className="pt-16 relative overflow-hidden">
                    <h1 className="mb-10 text-center frank-bold tracking-wide mx-auto max-w-2xl text-4xl font-bold tracking-tight text-gray-800 dark:text-gray-200 md:text-5xl lg:text-6xl">
                        Already moving your items with us?
                    </h1>
                    <Tracker />
                    <ul className="max-w-2xl mx-auto flex flex-col gap-3 md:items-center mt-4">
                        <li className="flex items-center gap-2">
                            <BsCheck2Circle size={20} className='text-green-600'/>
                            <span className='text-gray-700 dark:text-gray-300'>100% Free move monitoring.</span>
                        </li>
                        <li className="flex items-center gap-2">
                            <BsCheck2Circle size={20} className='text-green-600'/>
                            <span className='text-gray-700 dark:text-gray-300'>Real-time move updates daily.</span>
                        </li>
                        <li className="flex items-center gap-2">
                            <BsCheck2Circle size={20} className='text-green-600'/>
                            <span className='text-gray-700 dark:text-gray-300'>100% free move rescheuling after tracking</span>
                        </li>
                    </ul>
                </div>
            </section>
            <section className="pb-32">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-y-10 gap-x-6">
                    <div className="w-full space-y-12 order-2 lg:order-1">                        
                        <h1 className="capitolium font-extrabold tracking-wider text-4xl lg:text-5xl text-coral">Let's help you make <br /> moving things a cinch</h1>                        
                        <div className="md:flex md:items-start">
                            <span className="inline-block p-2 text-indigo-600 bg-indigo-100 dark:text-blue-600 dark:bg-blue-100 rounded-xl md:mr-4">
                            <IoReceiptOutline size={28}/>
                            </span>

                            <div className="mt-4 md:mx-4 md:mt-0">
                                <a href={route('quote')}
                                className="flex items-center gap-2 hover:underline text-xl frank-bold tracking-wider text-indigo-600 capitalize dark:text-blue-500"
                                >Get instant quote
                                <FaArrowRightLong size={20} />
                                </a>

                                <p className="mt-3 text-gray-500 dark:text-gray-300">
                                    Calculate your logistics costs instantly with our easy-to-use quote tool. Simply enter your details and receive a personalized quote in seconds.
                                </p>
                            </div>
                        </div>

                        <div className="md:flex md:items-start">
                            <span className="inline-block p-2 text-indigo-600 bg-indigo-100 dark:text-blue-600 dark:bg-blue-100 rounded-xl md:mr-4">
                            <BsUiChecks  size={28} />
                            </span>

                            <div className="mt-4 md:mx-4 md:mt-0">
                                <a href={''} className="flex items-center gap-2 hover:underline text-xl frank-bold tracking-wider text-indigo-600 capitalize dark:text-blue-500">Explore our services
                                <FaArrowRightLong size={20} />
                                </a>

                                <p className="mt-3 text-gray-500 dark:text-gray-300">
                                    Discover the wide range of logistics solutions we offer, from home moves to supply chain management.
                                </p>
                            </div>
                        </div>

                        <div className="md:flex md:items-start">
                            <span className="inline-block p-2 text-indigo-600 bg-indigo-100 dark:text-blue-600 dark:bg-blue-100 rounded-xl md:mr-4">
                            <FaHeadphonesAlt  size={28} />
                            </span>

                            <div className="mt-4 md:mx-4 md:mt-0">
                                <a href={route('contact')} className="flex items-center gap-2 hover:underline text-xl frank-bold tracking-wider text-indigo-600 capitalize dark:text-blue-500">Get in touch
                                <FaArrowRightLong size={20} />
                                </a>

                                <p className="mt-3 text-gray-500 dark:text-gray-300">
                                    Have questions or need assistance? Contact our friendly team today for expert advice and support.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="order-1 lg:order-2 flex items-center">
                        <img className={`w-full w-[28rem] h-[28rem] xl:w-[34rem] xl:h-[34rem] ${isDark ? 'object-cover rounded-2xl' : 'object-contain'}`} src={imgSrc} alt="Logistics vector illustration" />
                    </div>
                </div>
            </section>
        </div>
    )
}
