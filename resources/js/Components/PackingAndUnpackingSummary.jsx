import React, { useEffect, useState } from 'react'
import { PiWarning } from 'react-icons/pi';
import ClipLoader from 'react-spinners/ClipLoader';
import PrimaryButton from './PrimaryButton';
import { FaArrowLeft } from 'react-icons/fa6';

function PackingAndUnpackingSummary({ prev, reset }) {
    const [isLoading, setIsLoading] = useState(true);
    const [summary, setSummary] = useState(null);
    const [fetchError, setFetchError] = useState(null);
    useEffect(() => {
        const fetchSummary = async () => {
            try {
                const resp = await axios.get('/api/packing-unpacking-fetch-summary', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })

                setSummary(resp.data);
                setIsLoading(false);
                setFetchError(null);
            } catch (error) {
                if (error.response) {
                    setFetchError(error.response.data.message);
                    setIsLoading(false);
                } else {
                    console.error(error);
                    setFetchError(error);
                    setIsLoading(false);
                }
            }

        }

        let ignore = false

        if (!ignore) {
            fetchSummary();
        }

        return () => {
            ignore = true;
        }
    }, [])

    function handleSubmit() {
        setIsLoading(true);
        axios.get('/api/packing-unpacking/checkout', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(resp => {
            setIsLoading(false);
            setFetchError(null);
            localStorage.removeItem('packingUnpackingDetails');
            localStorage.removeItem('packingUnpackingItems');
            localStorage.removeItem('packingUnpackingUserInfo');

            if (resp.data.redirect && typeof resp.data.redirect === 'string') {
                window.location.href = resp.data.redirect;
            } else {
                setFetchError('Invalid redirect URL.');
            }
        }).catch(err => {
            if (err.response) {
                setIsLoading(false);
                setFetchError(err.response.data.message);
            } else {
                setIsLoading(false);
                setFetchError(err.message);
            }
        })
    }
    return (
        <div className='max-w-4xl mx-auto'>
            <h2 className="text-center text-3xl frank-bold lg:text-4xl text-gray-800 dark:text-gray-200">Summary of your request</h2>
            <div className="mt-10">
                {
                    isLoading ? <div className='h-[70vh] w-full flex justify-center items-center'>
                        <ClipLoader color='indigo' size={40} className='text-indigo-600 dark:text-blue-500' />
                    </div> : <>
                        {
                            fetchError ? <div>
                                <div className='w-full flex justify-center items-center gap-4 pt-10'>
                                    <PiWarning size={32} className='text-gray-800 dark:text-gray-200' />
                                    <p className='mb-3 text-lg frank-bold tracking-wide text-gray-800 dark:text-gray-200'>
                                        {fetchError}
                                    </p>
                                </div>
                                <div className="flex justify-center">
                                    <button
                                        onClick={reset}
                                        className='rounded-2xl py-2 px-5 text-sm uppercase border-2 border-indigo-600 dark:border-blue-500 bg-transparent text-gray-800 dark:text-gray-200 frank-bold'
                                    >reset</button>
                                </div>
                            </div> : <>
                                <div className='w-full max-w-4xl mx-auto'>
                                    {
                                        summary && <ul role='listbox' className="divide-y divide-gray-300 dark:divide-gray-700">
                                            <li className='py-2 px-4 hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 flex flex-col gap-2'>
                                                <span className='font-semibold text-md'>Address :</span>
                                                <span className='text-md'>{summary.address}</span>
                                            </li>
                                            <li className='py-2 px-4 hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 flex flex-col gap-2'>
                                                <span className='font-semibold text-md'>Request Type :</span>
                                                <span className='text-md capitalize'>{summary.serviceType}</span>
                                            </li>
                                            <li className='py-2 px-4 hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 flex flex-col gap-2'>
                                                <span className='font-semibold text-md'>Quote Items :</span>
                                                <span className='text-md'>{
                                                    summary.items.map(item => <div key={item.id}>{`${item.qty || ''} ${item.name}`}</div>)
                                                }</span>
                                            </li>
                                            <li className='py-2 px-4 hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 flex flex-col gap-2'>
                                                <span className='font-semibold text-md'>Preferred Date :</span>
                                                <span className='text-md'>{new Date(summary.date).toISOString().split("T")[0]}</span>
                                            </li>
                                        </ul>
                                    }

                                    <div className="mt-10 flex justify-center items-center gap-10">
                                        <PrimaryButton
                                            onClick={() => handleSubmit()}
                                            id="submitStep3"
                                            type="submit"
                                            className="w-3/5 disabled:bg-indigo-800">
                                            <span>Chat on WhatsApp</span>
                                        </PrimaryButton>
                                    </div>
                                    <div className="mt-10">
                                        <button
                                            onClick={prev}
                                            className="hover:underline outline-none border-0 text-sm font-semibold text-gray-700 dark:text-gray-400 inline-flex items-center gap-3">
                                            <FaArrowLeft className='size-7' />
                                            <span>Go back</span>
                                        </button>
                                    </div>
                                </div>
                            </>
                        }
                    </>
                }
            </div>
        </div>
    )
}

export default PackingAndUnpackingSummary