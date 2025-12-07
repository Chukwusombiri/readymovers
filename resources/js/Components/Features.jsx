import { usePage } from '@inertiajs/react'
import React from 'react'
import { GiCheckMark } from "react-icons/gi";
import ImageCarousel from './ImageCarousel';
import Section from './Section';
import SectionHeadingSpan from './SectionHeadingSpan';
import SectionHeading from './SectionHeading';

function Features() {
    const { companyName } = usePage().props.general;
    const features = [
        {
            id: 1,
            title: 'Real-time Tracking',
            description: 'ability to track your deliveries in real-time, ensuring transparency and peace of mind.'
        },
        {
            id: 2,
            title: 'Multiple Delivery Options',
            description: 'variety of delivery options such as express delivery, same-day delivery, next-day delivery.'
        },
        {
            id: 3,
            title: 'Customer Support',
            description: 'channels including live chat, email, and phone support to assist customers with any queries or issues they may have.'
        },
        {
            id: 4,
            title: 'A-rated moving teams',
            description: 'Based throughout the UK, our moving team always understand your moving needs '
        },
    ]

    const photoCarousel = [
        {
            imgUrl: '/images/landing/service1.jpg',
            imgAltText: 'service-1 photo',
        },
        {
            imgUrl: '/images/landing/service2.jpg',
            imgAltText: 'service-2 photo',
        },
        {
            imgUrl: '/images/landing/service3.jpg',
            imgAltText: 'service=3 photo',
        }
    ]
    return (
       <Section>
        <div className="max-w-6xl mx-auto px-6">
                <div className='flex flex-col mb-6'>
                    <SectionHeadingSpan title={'Why choose us'}/>
                    <SectionHeading title={'Let\'s handle your moves'} />
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p className="text-md text-gray-600 dark:text-gray-400 mb-4 max-w-md">
                            We're the key to seamless moves, efficient workflows, and a smooth supply chain. From home relocations and transportation to loading and unloading, we've got your back.
                        </p>
                        <div className="mt-8 max-w-xl space-y-5 text-base leading-7 text-gray-600 dark:text-gray-400 lg:max-w-none">
                            {
                                features.map((feature,idx) => (
                                    <div key={feature.id} className="flex flex-nowrap gap-4">
                                        <GiCheckMark className='size-6 text-green-600'/>
                                        <div className="" key={feature.id}>
                                            <span className="frank-bold text-gray-900 dark:text-gray-200 text-md mr-2">{feature.title}</span>
                                            <span className='text-gray-600 dark:text-gray-400 text-sm'>{feature.description}</span>
                                        </div>
                                    </div>
                                ))
                            }
                        </div>
                    </div>
                    <div className='w-full h-[50vh] lg:h-[70vh] rounded-lg overflow-hidden flex'>
                        <ImageCarousel imageCollection={photoCarousel} />
                    </div>
                </div>
            </div>
       </Section>
    )
}

export default Features