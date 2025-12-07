import React, { useEffect, useState } from 'react';
import { IoIosArrowBack } from "react-icons/io";

export default function ImageCarousel({ imageCollection = [] }) {
    const [current, setCurrent] = useState(0);
    const [isPaused, setIsPaused] = useState(false);

    useEffect(() => {
        if (imageCollection.length === 0 || isPaused) return;

        const timer = setInterval(() => {
            setCurrent(prev => (prev === imageCollection.length - 1 ? 0 : prev + 1));
        }, 2000);

        return () => clearInterval(timer);
    }, [imageCollection, isPaused]);

    if (imageCollection.length === 0) {
        return <div>No images available</div>;
    }

    const goToNext = () => {
        setCurrent(prev => (prev === imageCollection.length - 1 ? 0 : prev + 1));
    };

    const goToPrev = () => {
        setCurrent(prev => (prev === 0 ? imageCollection.length - 1 : prev - 1));
    };

    return (
        <div 
            className='w-full h-full flex relative overflow-hidden'
            onMouseEnter={() => setIsPaused(true)}
            onMouseLeave={() => setIsPaused(false)}
        >
            <div 
                className='w-full h-full flex transition-transform duration-500 ease-in-out'
                style={{ transform: `translateX(-${current * 100}%)` }}
            >
                {imageCollection.map((image, index) => (
                    <div key={index} className='w-full h-full flex-shrink-0'>
                        <img 
                            src={image.imgUrl} 
                            alt={image.imgAltText || 'Carousel Image'} 
                            className='w-full h-full object-cover'
                        />
                    </div>
                ))}
            </div>
            <button 
                onClick={goToPrev}
                className='absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2'
            >
                <IoIosArrowBack />
            </button>
            <button 
                onClick={goToNext}
                className='absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2'
            >
                <IoIosArrowBack className='rotate-180'/>
            </button>
        </div>
    );
}