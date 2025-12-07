import React from 'react'
import { FiCheckCircle } from "react-icons/fi";
import Section from './Section';
import SectionHeading from './SectionHeading';
import SectionHeadingSpan from './SectionHeadingSpan';
function HowItWorks() {
    const steps = [
        {
            title: 'Describe your move',
            description: 'Fill out a simple form for describing you move.'
        },
        {
            title: 'Receive your quote',
            description: 'See and compare our quote with others.'
        },
        {
            title: 'Complete booking',
            description: 'Proceed to checkout to as last step of booking.'
        },
    ];

    return (
        <Section>
            <div className="px-6 max-w-6xl mx-auto mt-10" >
                <div className="bg-indigo-100 dark:bg-blue-200 p-8 lg:p-10 rounded-lg">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div className="flex flex-col justify-center">
                            <SectionHeadingSpan title={'How it works'} className='text-indigo-600 dark:text-blue-600 text-md'/>
                            <h2 className="frank-bold text-3xl lg:text-4xl tracking-wide mb-4 md:mb-6 text-gray-700">
                                Start your move today
                            </h2>
                            <p className='text-gray-600 text-md max-w-sm'>
                                Enjoy a seamless move to your new home while we handle the heavy lifting. With Mazmoves, relocating is effortless and stress-free!
                            </p>
                        </div>
                        <div className="border-t lg:border-0 lg:border-l border-gray-400 dark:border-gray-700 pt-6 lg:p-6">
                            {
                                steps.map((item, idx) => (<div key={idx} className="w-full mb-6 last-child:mb-0 flex flex-nowrap gap-2">
                                    <FiCheckCircle className='size-6 text-green-500' />
                                    <div className="flex flex-col gap-1 md:gap-3">
                                        <h4 className='text-xl frank-bold tracking-wide text-gray-800'>{item.title}</h4>
                                        <p className="text-md text-gray-600">{item.description}</p>
                                    </div>
                                </div>))
                            }
                        </div>
                    </div>
                </div>
            </div>
        </Section>
    )
}

export default HowItWorks