import React from 'react'
import { IoIosArrowRoundForward } from "react-icons/io";
import SectionHeadingSpan from './SectionHeadingSpan';
import SectionHeading from './SectionHeading';
import Section from './Section';
export default function OurServices() {
    const servicesCollection = [
        {
            title: 'Home Moves',
            description: 'Streamline your relocation process with our efficient and reliable home moving service.',
            imgUrl: 'images/landing/service3.jpg',
            imgAltText: 'homes moves photo',
            url: route('quote.move')
        },
        {
            title: 'Home and Commercial Waste Removal',
            description: `Ensure eco-friendly disposal of your commercial waste with our specialized transportation
                        solutions. To start moving, get in touch with us today to discuss specifics.`,
            imgUrl: 'images/services/waste.jpg',
            imgAltText: 'commercial waste photo',
            url: route('quote.clearance')
        },
        {
            title: 'Packing and Unpacking',
            description: 'We also offer packing/packaging services and also unpacking/unpackaging services incase thats the only service you need.',
            imgUrl: 'images/services/home.jpg',
            imgAltText: 'packing and unpacking service photo',
            url: route('quote.packing_unpacking')
        },
    ];
    return (
        <Section>
            <div className="max-w-6xl mx-auto px-6">
                <SectionHeadingSpan title='services' />
                <SectionHeading title='What service do we offer' />
            </div>
            <div className="flex flex-nowrap lg:flex-wrap w-full lg:max-w-6xl mx-auto px-6 mt-6 overflow-x-auto pb-6">
                {
                    servicesCollection.map((item, idx) => (
                        <div key={idx} className="p-2 lg:p-4 w-[280px] md:w-[300px] lg:w-1/3 shrink-0">
                            <a href={item.url} className="flex flex-col gap-4 p-4 lg:p-6 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <img src={item.imgUrl} alt={item.imgAltText} className='w-full h-48'/>
                                <h4 className="text-xl frank-bold tracking-wide text-gray-800 dark:text-gray-200">{item.title}</h4>
                                <div className="flex items-center gap-2 text-coral dark:text-orange-500 cursor-pointer">
                                <span className="text-xs uppercase font-semibold">get instant quote</span>
                                <IoIosArrowRoundForward />
                                </div>
                            </a>
                        </div>
                    ))
                }
            </div>
        </Section>
    )
}
