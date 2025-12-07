import { Link, usePage } from '@inertiajs/react';
import React from 'react'
import Accordion from '../../Components/Accordion';

// Modern components for better organization
const FeatureCard = ({ icon, title, description, color = "indigo" }) => (
    <div className="relative pl-10 group">
        <div className={`absolute left-0 top-1 h-8 w-8 flex items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300`}>
            {icon}
        </div>
        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">{title}</h3>
        <p className="text-gray-600 dark:text-gray-300">{description}</p>
    </div>
);

const StatCard = ({ value, label, icon, gradient }) => {
    const clsx = `absolute inset-0 bg-gradient-to-br ${gradient} opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-300`;
    return <div className="relative group">
        <div className={clsx}></div>
        <div className="relative bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:border-gray-700 shadow-lg hover:shadow-xl transition-all duration-300">
            <div className="flex items-center gap-4">
                {icon && <div className="text-coral">{icon}</div>}
                <h4 className="hedvig-bold text-coral text-5xl md:text-6xl">{value}</h4>
            </div>
            <p className="text-lg md:text-xl mt-4 font-medium text-gray-800 dark:text-gray-200">{label}</p>
        </div>
    </div>    
};

export default function About({ faqArr }) {    
    const { companyName, companyRegNo } = usePage().props.general;

    const features = [
        {
            icon: (
                <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                </svg>
            ),
            title: "Reliability",
            description: "We go above and beyond to ensure that your transportation items are handled with care and delivered with precision, every time.",
            color: "emerald"
        },
        {
            icon: (
                <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 7H7v6h6V7z" />
                    <path fillRule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clipRule="evenodd" />
                </svg>
            ),
            title: "Innovation",
            description: "From cutting-edge technology to sustainable practices, we continuously seek new ways to improve our services and minimize our environmental footprint.",
            color: "blue"
        },
        {
            icon: (
                <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fillRule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clipRule="evenodd" />
                </svg>
            ),
            title: "Customer Focus",
            description: "Your satisfaction is our priority. We believe in building long-lasting relationships with our clients by providing personalized solutions.",
            color: "purple"
        }
    ];

    const stats = [
        {
            value: "6,000+",
            label: "Satisfied Clients",
            gradient: "from-emerald-400 to-cyan-400",
            icon: null
        },
        {
            value: "£5.6M+",
            label: "Customer Money Saved",
            gradient: "from-amber-400 to-orange-400",
            icon: null
        },
        {
            value: "5x Lower",
            label: "Less Fees Than Average",
            gradient: "from-rose-400 to-pink-400",
            icon: null
        }
    ];

    return (
        <div className="overflow-hidden">
            {/* Hero Section */}
            <section className="relative py-20 md:py-32 overflow-hidden bg-gradient-to-br from-white via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
                <div className="absolute inset-0 bg-grid-pattern opacity-5"></div>
                <div className="container px-6 mx-auto max-w-7xl">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div className="relative z-10">
                            <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-coral/10 text-coral text-sm font-semibold mb-6">
                                <span className="w-2 h-2 bg-coral rounded-full"></span>
                                Your Trusted Logistics Partner
                            </div>
                            <h1 className="hedvig-bold tracking-tight text-4xl md:text-5xl lg:text-6xl text-gray-900 dark:text-white leading-tight">
                                Delivering Excellence in <span className="text-coral">Every</span> Mile
                            </h1>
                            <p className="mt-6 text-lg text-gray-600 dark:text-gray-300 max-w-xl">
                                At {companyName}, we combine cutting-edge technology with personalized service to deliver logistics solutions that exceed expectations.
                            </p>
                            <div className="mt-8 flex flex-col sm:flex-row gap-4">
                                <Link 
                                    href='/contact-us'
                                    className="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-coral rounded-lg hover:bg-coral/90 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                                >
                                    Get Started
                                    <svg className="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </Link>
                                <Link 
                                    href='/our-services'
                                    className="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300"
                                >
                                    Explore Services
                                </Link>
                            </div>
                        </div>
                        <div className="relative">
                            <div className="relative rounded-2xl overflow-hidden shadow-2xl">
                                <img
                                    className="w-full h-[500px] object-cover"
                                    src='/images/about/hero.jpg'
                                    alt="Modern logistics warehouse with automated systems"
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>
                            <div className="absolute -bottom-6 -left-6 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl max-w-sm">
                                <div className="flex items-center gap-4">
                                    <div className="flex-shrink-0">
                                        <div className="w-12 h-12 bg-coral/10 rounded-lg flex items-center justify-center">
                                            <svg className="w-6 h-6 text-coral" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <p className="text-sm text-gray-500 dark:text-gray-400">Success Rate</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">99.8%</p>
                                        <p className="text-xs text-green-600">+2.4% from last year</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Mission & Vision */}
            <section className="py-20 bg-white dark:bg-gray-900">
                <div className="container px-6 mx-auto max-w-7xl">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                            Our Commitment to <span className="text-coral">Excellence</span>
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            We're redefining logistics through innovation, reliability, and customer-centric solutions.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div className="space-y-8">
                            <div>
                                <div className="flex items-center gap-3 mb-4">
                                    <div className="w-12 h-1 bg-coral rounded-full"></div>
                                    <span className="text-sm font-semibold text-coral uppercase tracking-wider">Who We Are</span>
                                </div>
                                <p className="text-gray-600 dark:text-gray-300 text-lg">
                                    At {companyName}, we are more than just a logistics company. With a commitment to reliability, efficiency, and customer satisfaction, we've built a reputation as a leading logistics provider (Company Registration Number: <strong>{companyRegNo}</strong>).
                                </p>
                            </div>

                            <div className="space-y-6">
                                {features.map((feature, index) => (
                                    <FeatureCard key={index} {...feature} />
                                ))}
                            </div>
                        </div>

                        <div className="relative">
                            <div className="relative rounded-2xl overflow-hidden shadow-2xl">
                                <img
                                    className="w-full h-[500px] object-cover"
                                    src='/images/about/who_we_are.jpg'
                                    alt="Team collaboration in modern office"
                                />
                                <div className="absolute inset-0 bg-gradient-to-tr from-coral/20 to-transparent"></div>
                            </div>
                            <div className="absolute -right-6 -bottom-6 bg-gray-900 text-white rounded-xl p-8 max-w-sm shadow-2xl">
                                <h3 className="text-2xl font-bold mb-3">Our Mission</h3>
                                <p className="text-gray-300">
                                    To streamline logistics processes, empower businesses, and create seamless experiences that deliver excellence in every aspect of our operations.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Stats Section */}
            <section className="py-20 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
                <div className="container px-6 mx-auto max-w-7xl">
                    <div className="text-center mb-16">
                        <h2 className="frank-regular text-3xl md:text-4xl lg:text-5xl text-gray-900 dark:text-white mb-4">
                            Numbers That <span className="text-coral">Speak</span> Volumes
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Our growth is a testament to our commitment to delivering exceptional value and service.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {stats.map((stat, index) => (
                            <StatCard key={index} {...stat} />
                        ))}
                    </div>

                    <div className="mt-16 bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                            <div className="text-center">
                                <div className="text-3xl font-bold text-coral">24/7</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400 mt-2">Support Available</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-coral">98%</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400 mt-2">On-Time Delivery</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-coral">50+</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400 mt-2">UK Cities Covered</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-coral">15min</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400 mt-2">Average Response Time</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* FAQ Section */}
            <section className="py-20">
                <div className="container px-6 mx-auto max-w-4xl">
                    <div className="text-center mb-12">
                        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-coral/10 text-coral text-sm font-semibold mb-4">
                            <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fillRule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clipRule="evenodd" />
                            </svg>
                            Common Questions
                        </div>
                        <h2 className="frank-regular text-3xl md:text-4xl lg:text-5xl text-gray-900 dark:text-white mb-4">
                            Frequently Asked <span className="text-coral">Questions</span>
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                            Find quick answers to common queries about our services and processes.
                        </p>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                        <Accordion accordionData={faqArr} />
                        <div className="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 text-center">
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Still have questions? We're here to help!
                            </p>
                            <Link 
                                href='/contact-us'
                                className="inline-flex items-center text-coral font-semibold hover:text-coral/80 transition-colors"
                            >
                                Contact our team
                                <svg className="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 relative overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-r from-coral to-purple-600 opacity-90"></div>
                <div className="absolute inset-0 bg-grid-pattern opacity-10"></div>
                <div className="container px-6 mx-auto max-w-7xl relative z-10">
                    <div className="max-w-4xl mx-auto text-center">
                        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 text-white text-sm font-semibold mb-6">
                            Join Our Community
                        </div>
                        <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                            Ready to Experience <span className="text-amber-300">Premium</span> Logistics?
                        </h2>
                        <p className="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                            Join thousands of satisfied clients who trust us with their logistics needs.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link 
                                href='/get-quote'
                                className="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-coral bg-white rounded-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                            >
                                Get Instant Quote
                                <svg className="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </Link>
                            <Link 
                                href='/contact-us'
                                className="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-transparent border-2 border-white rounded-lg hover:bg-white/10 transition-all duration-300"
                            >
                                Schedule Consultation
                            </Link>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}