import React, { useState } from 'react'
import { Head, usePage } from '@inertiajs/react';
import PackingAndUnPackingDetails from '../../Components/PackingAndUnPackingDetails';
import PackingAndUnPackingItems from '../../Components/PackingAndUnPackingItems';
import PackingAndUnPackingUserInfo from '../../Components/PackingAndUnPackingUserInfo';
import PackingAndUnpackingSummary from '../../Components/PackingAndUnpackingSummary';

export default function PackingUnpackingQuote() {
  const titleMeta = usePage().props.titleMeta;
  const [step, setStep] = useState(1);
  const [summaryKey, setSummaryKey] = useState(1);
  const stepsHeader = [
    {
      step: 1,
      heading: 'Tell us about your request'
    },
    {
      step: 2,
      heading: 'Let us know your items'
    },
    {
      step: 3,
      heading: 'Let us know you'
    },
  ];
  const stepSpanClasses = 'w-9 h-9 flex items-center justify-center font-bold text-sm rounded-full mr-2 border border-gray-300 dark:border-gray-700';

  return (
    <>
      <Head title={titleMeta} />
      <div className='pt-24 lg:pt-32 pb-20'>
        <div className="max-w-6xl mx-auto px-6">
          {
            step===4 
            ? <PackingAndUnpackingSummary key={summaryKey} prev={()=>setStep(3)} reset={()=>setSummaryKey(prev => prev + 1)} />
            : <section className='w-full'>
            {
              stepsHeader.map(header => {
                if (header.step !== step) {
                  return;
                }

                return <h2 key={header.step} className="text-center text-3xl lg:text-4xl frank-bold text-coral">
                  {header.heading}
                </h2>
              })
            }
            <div className="max-w-3xl mx-auto flex flex-nowrap items-center mt-4">
              <span className={`${stepSpanClasses} ${step >= 1 ? 'bg-blue-500 text-gray-100 dark:bg-green-500 dark:text-gray-900' : 'bg-inherit text-gray-600 dark:text-gray-400'}`}>1</span>
              <span className={`h-[1px] flex-grow ${step > 1 ? 'bg-blue-300 dark:bg-green-300' : 'bg-gray-600 dark:bg-gray-400'}`}></span>
              <span className={`${stepSpanClasses} ml-2 ${step >= 2 ? 'bg-blue-500 text-gray-100 dark:bg-green-500 dark:text-gray-900' : 'bg-inherit text-gray-600 dark:text-gray-400'}`}>2</span>
              <span className={`h-[1px] flex-grow ${step > 2 ? 'bg-blue-300 dark:bg-green-300' : 'bg-gray-600 dark:bg-gray-400'}`}></span>
              <span className={`${stepSpanClasses} ml-2 mr-0 ${step == 3 ? 'bg-blue-500 text-gray-100 dark:bg-green-500 dark:text-gray-900' : 'bg-inherit text-gray-600 dark:text-gray-400'}`}>3</span>
            </div>
            {step === 1 && <PackingAndUnPackingDetails next={() => setStep(2)} />}
            {step === 2 && <PackingAndUnPackingItems next={() => setStep(3)} prev={() => setStep(1)} />}
            {step === 3 && <PackingAndUnPackingUserInfo prev={() => setStep(2)} next={()=>setStep(4)}/>}
          </section> 
          }
        </div>
      </div>
    </>
  )
}
