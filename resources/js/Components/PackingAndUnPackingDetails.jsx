import React, { useEffect, useRef, useState } from 'react'
import { ToastContainer, toast } from 'react-toastify';
import { useAppContext } from '../Contexts/GeneralContextProvider';
import Input from './Input';
import { BsCheck2Circle } from 'react-icons/bs';
import { MdOutlineWrongLocation } from 'react-icons/md';
import fetchAddress from '../Utils/utils';
import Label from './Label';
import PrimaryButton from './PrimaryButton';
import Option from './Option';
import Select from './Select';
import axios from 'axios';
import { usePage } from '@inertiajs/react';
import ClipLoader from 'react-spinners/ClipLoader';

function PackingAndUnPackingDetails({ next }) {
    /* const PackingAndUnpackingSession = usePage().props.PackingAndUnpackingDetails;

    if (!PackingAndUnpackingSession) {
        localStorage.removeItem('packingUnpackingDetails');
        localStorage.removeItem('packingUnpackingItems');
        localStorage.removeItem('packingUnpackingUserInfo');
    } */

    const packingUnpackingDetails = localStorage.getItem('packingUnpackingDetails')
        ? JSON.parse(localStorage.getItem('packingUnpackingDetails'))
        : {
            postCode: '',
            address: '123 Neil Kent Rd, New port, London',
            serviceType: '',
            date: new Date().toISOString().split('T')[0],
        };
    const [bookingData, setBookingData] = useState(packingUnpackingDetails)
    const [errorBag, setErrorBag] = useState({})
    const [isLoading, setIsLoading] = useState(false);
    const { isDark } = useAppContext()
    const dateRef = useRef();

    /* date initializer */
    useEffect(() => {
        const today = new Date().toISOString().split('T')[0];
        if (dateRef.current) {
            dateRef.current.setAttribute('min', today);
        }
    }, [])

    function successCallBack(address, arr, field, sisterField) {
        setBookingData(prev => ({ ...prev, [field]: address }))
        setErrorBag(prevErrors => {
            const newErrors = {};
            if (Object.keys(prevErrors).length > 0) {
                for (const key in prevErrors) {
                    if (key !== sisterField) {
                        newErrors[key] = prevErrors[key]
                    }
                }
            }

            return newErrors;
        })
    }

    function errorCallBack(field, sisterField, errorMsg) {
        setErrorBag(prevErrors => ({ ...prevErrors, [sisterField]: errorMsg }));
        setBookingData(prevData => ({ ...prevData, [field]: '' }))
    }

    const handleBlur = (field, sisterField, data) => {
        if (data.trim()) {
            fetchAddress(data, field, sisterField, successCallBack, errorCallBack);
        } else {
            setBookingData(prevData => ({ ...prevData, [field]: '' }))
        }
    }

    const handleSubmit = async (e) => {
        e.preventDefault();



        for (const key in bookingData) {
            const value = bookingData[key]
            if (value === '') {
                const newErrors = { ...errorBag, [key]: 'This field cannot be empty' }
                setErrorBag(newErrors)
            }
        }

        if (Object.keys(errorBag).length > 0) return;

        try {
            setIsLoading(true);
            const resp = await axios.post('/api/packing-unpacking/details', bookingData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })

            setIsLoading(false)
            if (resp.status == 200) {
                toast.success(resp.data.message);
                setTimeout(() => {
                    localStorage.setItem('packingUnpackingDetails', JSON.stringify(bookingData));
                    setErrorBag({});
                    next();
                }, 5000)
            } else {
                toast.error('Ooops!! Unknown error occurred, try again please.')
            }
        } catch (error) {
            setIsLoading(false)
            if (error.response && error.response.status === 422) {
                setErrorBag(error.response.data.errors)
            } else {
                toast.error(error.message)
            }
        }
    }

    if (isLoading) {
        return (<div className='w-full h-[60vh] flex items-center justify-center'>
            <ClipLoader className='size-20' color='blue' />
        </div>)
    }


    return (
        <div className="mt-10 mb-20 max-w-3xl mx-auto">
            <ToastContainer theme={isDark ? 'dark' : 'light'} />
            <form onSubmit={handleSubmit} className='space-y-4'>
                <div className="flex flex-col gap-1">
                    <Label htmlFor={'postCode'} val="Post code" />
                    <Input
                        type="text"
                        id='postCode'
                        name='postCode'
                        value={bookingData.postCode}
                        onChange={(e) => setBookingData({ ...bookingData, postCode: e.target.value })} required
                        /* onBlur={(e) => handleBlur('address', 'postCode', e.target.value)} */ />
                    {bookingData.address && <p className="text-green-600 mt-1 flex items-center flex-nowrap gap-1"><BsCheck2Circle /><span>{bookingData.address}</span></p>}
                    {errorBag.postCode && <p className="text-red-600 mt-1 flex gap-1 items-center text-sm font-light tracking-wider"><MdOutlineWrongLocation />{errorBag.postCode}</p>}
                </div>
                <div className="flex flex-col gap-1">
                    <Label htmlFor={'serviceType'} val="choose service" />
                    <Select
                        name="serviceType"
                        id="serviceType"
                        value={bookingData.serviceType}
                        onChange={(e) => setBookingData({ ...bookingData, serviceType: e.target.value })}
                        className="text-sm text-gray-800 dark:text-gray-200 bg-inherit px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-indigo-700 dark:focus:border-blue-600">
                        <Option val='' placeholder={'choose service'} />
                        <Option val={'packing'} placeholder={'Packing/packaging items'} />
                        <Option val={'unpacking'} placeholder={'Unpacking/unpackaging items'} />
                    </Select>
                    {errorBag.serviceType && <p className="text-red-600 mt-1 flex gap-1 items-center text-sm font-light tracking-wider">{errorBag.serviceType}</p>}
                </div>
                <div className="flex flex-col gap-1">
                    <Label htmlFor={'date'} val="choose date" />
                    <input
                        className='w-full lg:w-[70%] text-sm text-gray-800 dark:text-gray-200 bg-inherit px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-indigo-700 dark:focus:border-blue-600'
                        ref={dateRef}
                        type="date"
                        name="date"
                        id="date"
                        value={bookingData.date}
                        onChange={(e) => setBookingData({ ...bookingData, date: e.target.value })} />
                    {errorBag.date && <p className="text-red-600 mt-1 flex gap-1 items-center text-sm font-light tracking-wider">{errorBag?.pickUpDate}</p>}
                </div>
                <div className="flex justify-center pt-6">
                    <PrimaryButton id="submitStep1" type="submit" className="w-3/5">
                        <span>next step</span>
                    </PrimaryButton>
                </div>
            </form>
        </div>
    )
}

export default PackingAndUnPackingDetails