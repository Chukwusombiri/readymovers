import { usePage } from '@inertiajs/react';
import React, { createContext, useContext, useEffect, useState } from 'react'

const AppContext = createContext(null);


export const useAppContext = () => useContext(AppContext);

function GeneralContextProvider({ children }) {
    const {
        companyName,
        companyAddress,
        companyPhone,
        fromAddress,
        replyToAddress,
        whatsappChatLink,
        instagramLink,
        facebookLink,
        xLink } = usePage().props.general;
    const storedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = storedTheme ? storedTheme === 'dark' : prefersDark;
    const [isDark, setIsDark] = useState(initialTheme);

    useEffect(() => {
        if (isDark) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    }, [isDark]);

    return (
        <AppContext.Provider value={
            {
                companyName,
                companyAddress,
                companyPhone,
                fromAddress,
                replyToAddress,
                whatsappChatLink,
                instagramLink,
                facebookLink,
                xLink,
                isDark,
                setIsDark
            }
        }>
            {children}
        </AppContext.Provider>
    )
}

export default GeneralContextProvider