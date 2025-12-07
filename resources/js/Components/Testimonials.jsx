import { usePage } from '@inertiajs/react'
import React from 'react'
import { FaStar } from "react-icons/fa";
import SectionHeadingSpan from './SectionHeadingSpan';
import SectionHeading from './SectionHeading';
import Section from './Section';
export default function Testimonials() {
  const { companyName } = usePage().props.general;
  const testimonialsCollection = [
    {
      client: 'Frank Renolds - CEO',
      org: 'of Bright Ideas Ltd',
      comment: `We\'ve had the pleasure of partnering with ${companyName} for several years now, and they never disappoint`
    },
    {
      client: 'Leland Keith - Operation Manager',
      org: 'at Smith & Co.',
      comment: `${companyName} efficient and reliable service has helped us meet our delivery deadlines consistently.`
    },
    {
      client: `Veron Nicolas - CEO`,
      org: 'at Protopter Inc.',
      comment: `${companyName} is the fastest and the most reliable logistics service we have ever used, no frills.`
    },
  ];

  return (
    <Section className='overflow-hidden'>
      <div className="w-full max-w-6xl mx-auto px-6 lg:mb-10">
        <SectionHeadingSpan title={'Client reviews'} />
        <SectionHeading title={'What our customers have said'} />
      </div>
      <div className="flex flex-nowrap w-full lg:max-w-6xl mx-auto px-6 mt-6 overflow-x-auto pb-6">
        {
          testimonialsCollection.map((item, idx) => (
            <div key={idx} className="px-4 w-[280px] md:w-[300px] lg:w-1/3 shrink-0">
              <div className="flex flex-col gap-4 p-4 lg:p-6 rounded-xl border border-gray-300 dark:border-gray-700">
                <div className="flex flex-nowrap gap-1.5 items-center">
                  {
                    Array(5).fill('').map((item, idx) => (<FaStar className='text-yellow-500 size-6' key={idx} />))
                  }
                </div>
                <p className="text-md text-gray-700 dark:text-gray-300 tracking-wide capitolium">"{item.comment}"
                </p>
                <div>
                  <h4 className="font-semibold text-md text-gray-800 dark:text-gray-200 tracking-wider">{item.client}</h4>
                  <span className='text-sm text-gray-500 dark:text-gray-400'>{item.org}</span>
                </div>
              </div>
            </div>
          ))
        }
      </div>
    </Section>
  )
}
