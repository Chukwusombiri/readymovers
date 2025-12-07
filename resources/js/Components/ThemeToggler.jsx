import React, { useEffect, useState } from 'react';
import { MdOutlineLightMode, MdDarkMode } from "react-icons/md";
import { useAppContext } from '../Contexts/GeneralContextProvider';
import { IoSunny } from "react-icons/io5";

function ThemeToggler({}) {
    const {isDark, setIsDark} = useAppContext();
    function toggleDark() {
        setIsDark(!isDark);
    }

    return (
        <button 
            onClick={toggleDark} 
            className={`w-14 md:w-10 rounded-full flex items-center border border-gray-500 dark:border-gray-400 ${isDark ? 'p-1' : 'p-0.5'}  bg-gray-200 dark:bg-gray-600 transition-all duration-300 ${isDark ? 'justify-end' : 'justify-start'}`}
        >
            {isDark ? <IoSunny className='text-gray-200 size-4'/> : <MdDarkMode className="text-gray-800 size-5"/>}
        </button>
    );
}

export default ThemeToggler;