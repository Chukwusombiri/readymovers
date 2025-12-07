import React from 'react'
import Navigation from '../Components/Navigation'
import Footer from '../Components/Footer'
import GeneralContextProvider from '../Contexts/GeneralContextProvider'

function GeneralLayout({ children }) {
    return (
        <GeneralContextProvider>
            <div className="min-h-screen bg-white dark:bg-gray-900 flex flex-col justify-between">
                <div>
                    <Navigation />
                    {children}
                </div>
                <Footer />
            </div>
        </GeneralContextProvider>
    )
}

export default GeneralLayout