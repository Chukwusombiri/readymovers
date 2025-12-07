import { Link } from '@inertiajs/react'
import React from 'react'
import { useAppContext } from '../Contexts/GeneralContextProvider'
import ApplicationLogo from './ApplicationLogo';
import { SlSocialInstagram } from "react-icons/sl";
import { FaXTwitter } from "react-icons/fa6";
import { FaFacebookSquare } from "react-icons/fa";
import { SiWhatsapp } from "react-icons/si";
import { MdAlternateEmail } from "react-icons/md";
import { FaMapPin } from 'react-icons/fa6';

function Footer() {
  const { companyName, companyAddress, fromAddress, replyToAddress, whatsappChatLink, instagramLink, facebookLink, xLink } = useAppContext()
  return (
    <footer className="border-t border-neutral-700/20 pt-10 bg-gray-100 dark:bg-gray-900 dark:text-gray-300 overflow-x-hidden">
      <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div className="flex flex-wrap items-center justify-between gap-10 md:items-start lg:flex-nowrap">
          <div className="w-full md:w-2/3">
            <div className="grid grid-cols-2 gap-4 text-sm sm:grid-cols-3 sm:gap-6 md:grid-cols-4 md:pr-4">
              <div>
                <h3 className="font-bold uppercase text-indigo-700 dark:text-blue-500">Pages</h3>
                <ul className="mt-4 space-y-2 text-gray-700 dark:text-gray-400">                  
                  <li><Link href={route('quote')}>Quote</Link></li>
                  <li><Link href={route('tracker')}>Track</Link></li>
                  <li><Link href={route('about') + '#faq'}>FAQ</Link></li>
                  <li><Link href={route('about')}>Organization</Link></li>
                </ul>
              </div>
              <div>
                <h3 className="font-bold uppercase text-indigo-700 dark:text-blue-500">Support</h3>
                <ul className="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                  <li><Link href={`mailto:${fromAddress}`}>Request Feedback</Link></li>
                  <li><Link href={`mailto:${fromAddress}`}>Submit Bugs</Link></li>
                  <li><Link href={route('contact')}>Contact Us</Link></li>
                </ul>
              </div>
              <div>
                <h3 className="font-bold uppercase text-indigo-700 dark:text-blue-500">Legal</h3>
                <ul className="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                  <li><Link href={route('policy.show')}>Privacy Policy</Link></li>
                  <li><Link href={route('terms.show')}>Terms of service</Link></li>                  
                </ul>
              </div>
              <div>
                <h3 className="font-bold uppercase text-indigo-700 dark:text-blue-500">Contact</h3>
                <ul className="mt-4 space-y-2 text-gray-700 dark:text-gray-400">
                  <li className="">
                    <Link href={`mailto:${replyToAddress}`} className="flex gap-2 items-center">
                      <MdAlternateEmail />
                      <span>{replyToAddress}</span>
                    </Link>
                  </li>
                  <li className="">
                    <Link href={whatsappChatLink} className="flex gap-2 items-center" target="_blank">
                      <SiWhatsapp />
                      <span>Whatsapp</span>
                    </Link>
                  </li>
                  <li className="">
                    <Link href={facebookLink} className="flex gap-2 items-center" target="_blank">
                      <FaFacebookSquare />
                      <span>Facebook</span>
                    </Link>
                  </li>
                  <li className="">
                    <Link href={instagramLink} className="flex gap-2 items-center" target="_blank">
                      <SlSocialInstagram />
                      <span>Instagram</span>
                    </Link>
                  </li>
                  <li className="">
                    <Link href={xLink} className="flex gap-2 items-center" target="_blank">
                      <FaXTwitter />
                      <span>X (formerly Twitter)</span>
                    </Link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div className="w-full md:w-2/3 lg:w-1/3">
            <Link href="/">
              <ApplicationLogo classList="block h-24 w-auto" />
            </Link>
            <p className="mb-4 text-gray-700 dark:text-gray-300">
              With a commitment to reliability, efficiency, and customer satisfaction, we have built a reputation as a leading provider of home moving and transportation services in the UK.</p>
            <p className="flex items-center gap-2 flex-wrap text-gray-700 dark:text-gray-300">
              <FaMapPin />
              <span>{companyAddress}</span>
            </p>
          </div>
        </div>
      </div>
      <div className="mt-10 flex justify-center text-sm text-gray-500 dark:text-gray-400 py-4 px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl text-center">© {new Date().getFullYear()} {companyName} All rights reserved. </div>
      </div>
    </footer>
  )
}

export default Footer