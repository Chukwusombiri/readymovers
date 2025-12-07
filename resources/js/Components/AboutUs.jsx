import React from 'react'
import { FaArrowRightLong } from "react-icons/fa6";
import Section from './Section';
import SectionHeadingSpan from './SectionHeadingSpan';
import SectionHeading from './SectionHeading';
function AboutUs() {
    return (
        <Section>
            <div className="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 justify-center gap-6">
                <div className="flex flex-col gap-3">
                    <div className='mb-2'>
                        <SectionHeadingSpan title={'About us'} />
                        <SectionHeading title={'Trusted All Over UK'} className={'capitolium text-gray-700 dark:text-gray-200 font-bold'}/>                        
                    </div>
                    <p className="text-sm leading-loose text-gray-600 dark:text-gray-400 max-w-md">
                        With a commitment to reliability, efficiency, and customer satisfaction, we've built a reputation as a leading logistics provider in the UK providing stress-free moves.
                    </p>
                    <div>
                        <a href={route('about')} className="font-bold text-blue-600 dark:text-blue-500 hover:border-b-2 border-blue-600 dark:border-blue-500  inline-flex pb-1 gap-2 text-xs uppercase tracking-wider">
                            <span>learn about us</span>
                            <FaArrowRightLong />
                        </a>
                    </div>
                </div>
                <div className="flex flex-col gap-2 border border-gray-300 dark:border-gray-700 p-6 lg:p-10">
                    <h2 className='text-2xl lg:text-3xl text-gray-800 dark:text-gray-300 font-bold'>Do you want to talk ?</h2>
                    <p className="text-md text-gray-600 dark:text-gray-400">
                        Our team is always available to meet your needs and answer any questions you may have. Don’t hesitate — reach out to us today!
                    </p>
                    <div className='w-full mt-4 lg:mt-6'>
                        <a href={route('contact')} className="bg-indigo-700 dark:bg-blue-700 hover:bg-indigo-800 dark:hover:bg-blue-800 text-white text-xs uppercase font-semibold tracking-wide px-6 py-3 lg:px-8 lg:py-4">Contact us</a>
                    </div>
                </div>
            </div>
        </Section>
    )
}

export default AboutUs