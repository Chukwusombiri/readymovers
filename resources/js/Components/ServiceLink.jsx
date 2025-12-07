import { Link } from '@inertiajs/react';
import React, { useState } from 'react'
import { FaAngleRight } from "react-icons/fa6";

function ServiceLink({ service }) {
    const [isHovered, setIsHovered] = useState(false);
    const styles = {
        backgroundImage: '',
    }
    return (
        <Link
            href={service.href}
            onMouseOver={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            className="rounded-2xl overflow-hidden flex transition-all relative">
            <img
                src={service.imgUrl}
                className={`w-full h-auto transform transition-transform duration-300 ${isHovered ? 'scale-110' : 'scale-100'}`}
                alt={service.heading}
            />
            <div className="absolute inset-0 w-full p-6 shadow bg-gray-900 bg-opacity-30 backdrop-blur-[1px] flex">
                <div className="w-full h-full flex flex-col justify-between">
                    <div>
                        <h4 className="frank-bold text-lg tracking-wide capitalize text-gray-100 mb-3">
                            {service.heading}
                        </h4>
                        <p className="text-md text-gray-100 tracking-wide">
                            {service.description}
                        </p>
                    </div>
                    <div className="flex mt-4">
                        <span className="rounded-full w-10 h-10 border border-gray-400 inline-flex justify-center items-center">
                            <FaAngleRight size={20} className='size-5 text-gray-200' />
                        </span>
                    </div>
                </div>
            </div>
        </Link>
    )
}

export default ServiceLink