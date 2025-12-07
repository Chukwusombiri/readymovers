import { Link } from '@inertiajs/react'
import React, { useState } from 'react'
import { FaArrowRightLong } from 'react-icons/fa6'
import PrimaryButton from './PrimaryButton';
import axios from 'axios';

function Tracker() {
    const [refNo, setRefNo] = useState('');
    const [type, setType] = useState('monitoring');
    const [errorBag, setErrorBag] = useState(null);

    const handleSubmit = async () => {
        try {
            const resp = await axios.get(`/api/track-move?refId=${refNo}&type=${type}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            setRefNo('');
            setErrorBag(null);
            const whatsappChatLink = (resp).data.redirect;
            if (whatsappChatLink && typeof whatsappChatLink === 'string') {
                window.location.href = resp.data.redirect;
            } else {
                setErrorBag('Invalid redirect URL.');
            }
        } catch (error) {
            if (error.response) {
                setErrorBag(error.response.data.errors.refId)
            } else {
                setErrorBag(error.message);
            }
        }
    }
    return (
        <div className="lg:w-full mt-8 bg-indigo-100 dark:bg-blue-100 rounded-xl p-6 lg:p-8">
            <div className="flex gap-4 flex-wrap mb-3">
                <div className='py-3 flex gap-2 items-center'>
                    <input 
                    className='size-7'
                    type="radio" 
                    name="monitoring" 
                    id="monitoring" 
                    defaultValue={'monitoring'} 
                    checked={type==='monitoring'}
                    onChange={(e)=>setType(e.target.value)}/>
                    <label className='text-lg' htmlFor='monitoring'>Monitoring</label>
                </div>
                <div className='py-3 flex gap-2 items-center'>
                    <input 
                    className='size-7'
                    type="radio" 
                    name="rescheduling" 
                    id="rescheduling"                     
                    defaultValue={'rescheduling'} 
                    checked={type==='rescheduling'}
                    onChange={(e)=>setType(e.target.value)}/>
                    <label className='text-lg' htmlFor='rescheduling'>Rescheduling</label>
                </div>                
            </div>
            <div className="flex flex-wrap justify-center">
                <input
                    value={refNo}
                    onChange={(e) => setRefNo(e.target.value)}
                    type="text" name="refNo" id="refNo" placeholder='Booking Ref ID ...'
                    className='w-full lg:w-3/5 p-3 rounded-xl bg-inherit text-gray-800 text-md placeholder:text-gray-600 placeholder:uppercase border-gray-400 focus:border-indigo-500 dark:focus:border-blue-400' />
                <div className="lg:w-2/5 pt-4 lg:pl-3 lg:pt-0 flex">
                    <PrimaryButton
                        onClick={handleSubmit}
                        className='w-full hover:opacity-90 flex justify-center gap-2 items-center'>
                        <span className='uppercase tracking-widest'>
                            Track booking
                        </span>
                        <FaArrowRightLong size={20} />
                    </PrimaryButton>
                </div>
            </div>            
            {
                errorBag && <p className='text-md text-rose-600 mt-2'>{errorBag}</p>
            }
        </div>
    )
}

export default Tracker