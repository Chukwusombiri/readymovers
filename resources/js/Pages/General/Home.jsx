import React from 'react'
import Hero from '../../Components/Hero'
import HowItWorks from '../../Components/HowItWorks'
import Features from '../../Components/Features'
import { Head, usePage } from '@inertiajs/react'
import Testimonials from '../../Components/Testimonials'
import Cta from '../../Components/Cta'
import AboutUs from '../../Components/AboutUs'
import OurServices from '../../Components/OurServices'

function Home() {   
  const {titleMeta} = usePage().props; 
  return (
    <div>
        <Head title={titleMeta} />
        <Hero />
        <HowItWorks />
        <Features />
        <Testimonials />
        <Cta />
        <AboutUs />
        <OurServices />
    </div>
  )
}

export default Home