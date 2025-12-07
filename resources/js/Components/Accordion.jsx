import React from 'react'

export default function Accordion({ accordionData }) {
    const [activeIndex, setActiveIndex] = React.useState(null);

    const toggleAccordion = (index) => {
        setActiveIndex(activeIndex === index ? null : index);
    };
    return (
        <div>
            {accordionData.map((item, index) => (
                <div key={index} className="border-b border-gray-200 dark:border-gray-700">
                    <button
                        onClick={() => toggleAccordion(index)}
                        className="w-full text-left py-4 flex justify-between items-center focus:outline-none"
                    >
                        <span className="text-lg font-medium text-gray-800 dark:text-gray-200">{item.question}</span>
                        <svg
                            className={`w-6 h-6 transform transition-transform duration-300 ${activeIndex === index ? 'rotate-180' : ''}`}
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >   
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    {activeIndex === index && (
                        <div className="pb-4 text-gray-600 dark:text-gray-400">
                            {item.answer}
                        </div>
                    )}
                </div>
            ))}
        </div>
    )
}
