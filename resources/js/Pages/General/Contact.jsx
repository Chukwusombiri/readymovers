import { usePage } from '@inertiajs/react';
import React from 'react'
import ContactForm from '../../Components/ContactForm';

const ContactInfoCard = ({ icon, title, content, index }) => (
    <div
        className="group relative bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1"
        style={{ animationDelay: `${index * 100}ms` }}
    >
        <div className="absolute -top-4 left-6">
            <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-coral to-orange-500 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                {icon}
            </div>
        </div>
        <div className="pt-4">
            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-3">{title}</h3>
            <div className="space-y-2 text-gray-600 dark:text-gray-300">
                {content}
            </div>
        </div>
        <div className="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-coral to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>
);

export default function Contact() {
    const {
        companyName,
        companyAddress,
        companyPhone,
        fromAddress,
        replyToAddress,
        companyRegNo,
        companyPostCode,
        xlink,
        facebookLink,
        instagramLink,
        whatsappChatLink
    } = usePage().props.general;

    const socialPlatforms = [
        {
            name: 'facebook', url: facebookLink || '#', icon: (
                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
            )
        },
        {
            name: 'twitter', url: xlink || '#', icon: (
                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-2.723 0-4.928 2.206-4.928 4.928 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.247-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.112-.849.171-1.296.171-.317 0-.626-.03-.928-.086.627 1.956 2.444 3.379 4.6 3.419-1.68 1.318-3.809 2.105-6.102 2.105-.396 0-.787-.023-1.17-.067C2.179 19.29 4.768 20 7.548 20c9.142 0 14.307-7.721 14.307-14.416 0-.22-.005-.439-.014-.656C22.505 6.411 23.34 5.543 24 4.557z" />
                </svg>
            )
        },
        {
            name: 'instagram', url: instagramLink || '#', icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    <path d="M16.5 7.5v.01" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                </svg>
            )
        },
        {
            name: 'whatsapp', url: whatsappChatLink || '#', icon: (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                </svg>
            )
        }
    ]

    const contactInfo = [
        {
            icon: (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            ),
            title: "Our Address",
            content: (
                <>
                    <p className="font-medium">{companyAddress}</p>
                    <p>{companyPostCode}</p>
                    <p className="text-sm text-gray-500 dark:text-gray-400">United Kingdom</p>
                </>
            )
        },
        {
            icon: (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            ),
            title: "Contact Information",
            content: (
                <>
                    <a href={`tel:${companyPhone}`} className="block hover:text-coral transition-colors duration-200">
                        <span className="font-medium">Phone:</span> {companyPhone}
                    </a>
                    <a href={`https://wa.me/${companyPhone.replace(/\D/g, '')}`} className="block hover:text-coral transition-colors duration-200">
                        <span className="font-medium">WhatsApp:</span> {companyPhone}
                    </a>
                    <a href={`mailto:${replyToAddress}`} className="block hover:text-coral transition-colors duration-200">
                        <span className="font-medium">Email:</span> {replyToAddress}
                    </a>
                </>
            )
        },
        {
            icon: (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            ),
            title: "Working Hours",
            content: (
                <>
                    <div className="flex justify-between items-center py-1">
                        <span className="text-gray-500 dark:text-gray-400">Mon - Fri</span>
                        <span className="font-medium">08:00 - 17:00</span>
                    </div>
                    <div className="flex justify-between items-center py-1">
                        <span className="text-gray-500 dark:text-gray-400">Saturday</span>
                        <span className="font-medium">08:00 - 12:00</span>
                    </div>
                    <div className="flex justify-between items-center py-1">
                        <span className="text-gray-500 dark:text-gray-400">Sunday</span>
                        <span className="font-medium">Closed</span>
                    </div>
                </>
            )
        },
        {
            icon: (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            ),
            title: "Company Registration",
            content: (
                <div className="space-y-1">
                    <p className="font-medium">Registered in England & Wales</p>
                    <p className="text-sm text-gray-500 dark:text-gray-400">Company Number: {companyRegNo}</p>
                    <p className="text-xs text-gray-400 dark:text-gray-500 mt-2">Fully licensed and insured</p>
                </div>
            )
        }
    ];

    return (
        <div className="overflow-hidden">
            {/* Hero Section */}
            <section className="relative py-20 md:py-32 min-h-[70vh] flex items-center justify-center overflow-hidden">
                <div
                    className="absolute inset-0 bg-cover bg-center bg-no-repeat"
                    style={{
                        backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/contact/agents.jpg')`
                    }}
                >
                    <div className="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black/50"></div>
                </div>

                {/* Animated background elements */}
                <div className="absolute inset-0">
                    <div className="absolute top-1/4 left-1/4 w-64 h-64 bg-coral/10 rounded-full blur-3xl animate-pulse"></div>
                    <div className="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
                </div>

                <div className="container mx-auto px-6 relative z-10 text-center">
                    <div className="max-w-4xl mx-auto">
                        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-coral/20 text-coral text-sm font-semibold mb-6">
                            <span className="w-2 h-2 bg-coral rounded-full animate-pulse"></span>
                            Contact Us
                        </div>
                        <h1 className="hedvig-bold text-4xl md:text-5xl lg:text-6xl text-white mb-6 leading-tight">
                            Let's <span className="text-coral">Connect</span> & Create Solutions
                        </h1>
                        <p className="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto">
                            Ready to transform your logistics experience? Get in touch with our expert team today.
                        </p>
                        <div className="flex flex-wrap gap-4 justify-center">
                            <a
                                href={`tel:${companyPhone}`}
                                className="inline-flex items-center px-6 py-3 bg-coral text-white rounded-lg hover:bg-coral/90 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                            >
                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Call Now
                            </a>
                            <a
                                href="#form"
                                className="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm text-white border border-white/30 rounded-lg hover:bg-white/20 transition-all duration-300"
                            >
                                Send Message
                            </a>
                        </div>
                    </div>
                </div>

                {/* Scroll indicator */}
                <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2">
                    <div className="animate-bounce">
                        <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
            </section>

            {/* Contact Section */}
            <section className="py-20 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800" id="contact">
                <div className="container mx-auto px-6 max-w-7xl">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                            Get in Touch <span className="text-coral">Today</span>
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Have questions or ready to start your project? Reach out through any channel below.
                        </p>
                    </div>

                    <div className="grid lg:grid-cols-3 gap-8 mb-16">
                        {/* Contact Information */}
                        <div className="lg:col-span-1 space-y-8">
                            <div className="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl">
                                <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                                    Contact Information
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-8">
                                    We're here to help you with any questions about our services. Reach out through any of these channels.
                                </p>

                                <div className="space-y-6">
                                    {contactInfo.map((info, index) => (
                                        <ContactInfoCard key={index} index={index} {...info} />
                                    ))}
                                </div>

                                {/* Social Links */}
                                <div className="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">
                                    <h4 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                        Follow Us
                                    </h4>
                                    <div className="flex space-x-4">
                                        {socialPlatforms.map((platform, index) => (
                                            <a
                                                key={index}
                                                href={platform.url}
                                                className="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-coral hover:text-white transition-all duration-300"
                                                aria-label={platform.name}
                                            >
                                                {platform.icon}
                                            </a>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Contact Form */}
                        <div className="lg:col-span-2" id="form">
                            <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10">
                                <div className="mb-8">
                                    <div className="flex items-center gap-3 mb-2">
                                        <div className="w-12 h-1 bg-coral rounded-full"></div>
                                        <span className="text-sm font-semibold text-coral uppercase tracking-wider">
                                            Send Message
                                        </span>
                                    </div>
                                    <h3 className="text-3xl font-bold text-gray-900 dark:text-white">
                                        Send Us Your Inquiry
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300 mt-2">
                                        Fill out the form below and our team will get back to you within 24 hours.
                                    </p>
                                </div>

                                <ContactForm />

                                <div className="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                                    <div className="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                        <svg className="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>We typically respond within 2-4 business hours</span>
                                    </div>
                                </div>
                            </div>

                            {/* Map/Office Hours Info */}
                            <div className="mt-8 grid md:grid-cols-2 gap-6">
                                <div className="bg-gradient-to-br from-coral/5 to-blue-500/5 rounded-xl p-6 border border-coral/20">
                                    <h4 className="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        <span className="text-coral">Fast</span> Response Guarantee
                                    </h4>
                                    <ul className="space-y-2 text-gray-600 dark:text-gray-300">
                                        <li className="flex items-center gap-2">
                                            <svg className="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                                            </svg>
                                            Urgent queries: 1-hour response
                                        </li>
                                        <li className="flex items-center gap-2">
                                            <svg className="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                                            </svg>
                                            Email support: 24/7 availability
                                        </li>
                                        <li className="flex items-center gap-2">
                                            <svg className="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                                            </svg>
                                            Phone support: Extended hours
                                        </li>
                                    </ul>
                                </div>
                                <div className="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                                    <h4 className="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        Office Location
                                    </h4>
                                    <div className="aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg mb-3 flex items-center justify-center">
                                        <div className="text-center">
                                            <svg className="w-12 h-12 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clipRule="evenodd" />
                                            </svg>
                                            <p className="text-sm text-gray-500 dark:text-gray-400">Interactive map</p>
                                        </div>
                                    </div>
                                    <p className="text-sm text-gray-600 dark:text-gray-300">
                                        Visit our headquarters in {companyAddress.split(',')[0]}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* CTA Banner */}
                    <div className="bg-gradient-to-r from-coral to-orange-500 rounded-2xl p-8 md:p-12 text-center text-white shadow-xl">
                        <div className="max-w-3xl mx-auto">
                            <h3 className="text-2xl md:text-3xl font-bold mb-4">
                                Need Immediate Assistance?
                            </h3>
                            <p className="text-lg mb-6 opacity-90">
                                Call our emergency support line for urgent logistics issues
                            </p>
                            <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
                                <a
                                    href={`tel:${companyPhone}`}
                                    className="inline-flex items-center px-8 py-3 bg-white text-coral font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-lg"
                                >
                                    <svg className="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Emergency: {companyPhone}
                                </a>
                                <span className="text-white/70">
                                    Available 24/7 for urgent matters
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}