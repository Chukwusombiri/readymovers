import { Link } from '@inertiajs/react'
import React, { useEffect, useRef } from 'react'
import ServiceLink from '../../Components/ServiceLink';

function Quote({ partners }) {
    const quoteTypes = [
        {
            id: 1,
            href: route('quote.move'),
            imgUrl: '/images/services/european.jpg',
            heading: 'Home and Office moves',
            description: 'Get instant quote for your home, offices, warehouse moves.'
        },
        {
            id: 2,
            href: route('quote.clearance'),
            imgUrl: '/images/services/waste.jpg',
            heading: 'Removal and clearance',
            description: 'Find out what it\'ll cost to clear out a space and removes junks.'
        },
        {
            id: 3,
            href: route('quote.packing_unpacking'),
            imgUrl: '/images/services/home.jpg',
            heading: 'Packing and Un-packing',
            description: 'Let\'s cost you for packing services or unpacking services in no time.'
        },
    ];

    return (
        <div>
            <section className="pt-24 lg:pt-32 pb-20">
                <div className="max-w-6xl mx-auto px-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                        {
                            quoteTypes.map(type => <ServiceLink key={type.id} service={type} />)
                        }
                    </div>
                </div>
            </section>
            {
                partners && <section className="mt-12 pt-24 pb-24 lg:pb-32 bg-neutral-50">
                    <div className="max-w-6xl mx-auto px-6">
                        <h2 className="text-3xl frank-bold lg:text-4xl text-center text-gray-800 dark:text-gray-200 tracking-wide mb-10">
                            Some of our notable partners
                        </h2>
                        <div className="flex flex-wrap justify-center gap-4">
                            {
                                partners.map((partner, idx) => <a key={idx} href={partner.url} title={partner.description} className='flex flex-col items-center w-full max-w-[200px]'>
                                    {partner.imgUrl
                                        ? <img src={partner.imgUrl} alt={partner.name + '\'s logo'} className='w-32 h-32' />
                                        : <h2 className='capitolium font-extrabold text-5xl tracking-wide text-zinc-700'>{partner.alias}</h2>
                                    }                                    
                                </a>)
                            }
                        </div>
                    </div>
                </section>
            }
        </div>
    )
}

export default Quote