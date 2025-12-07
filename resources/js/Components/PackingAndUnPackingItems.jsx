import axios from 'axios'
import React, { useEffect, useState } from 'react'
import ClipLoader from 'react-spinners/ClipLoader';
import { toast, ToastContainer } from 'react-toastify';
import Label from './Label';
import { IoClose } from "react-icons/io5";
import PrimaryButton from './PrimaryButton';
import { FaArrowLeft } from "react-icons/fa6";
import { FaAngleDown } from "react-icons/fa6";
import { BiCollapseAlt } from "react-icons/bi";


export default function PackingAndUnPackingItems({ next, prev }) {
    const packingUnpackingItems = JSON.parse(localStorage.getItem('packingUnpackingItems')) || [];
    const storedCheckedIds = packingUnpackingItems.length > 0 ? packingUnpackingItems.map(str => str.id) : [];
    const [isLoading, setIsLoading] = useState(true)
    const [items, setItems] = useState(packingUnpackingItems);
    const [isOpen, setIsOpen] = useState(false);
    const [checkedIds, setCheckedIds] = useState(storedCheckedIds);
    const [allItems, setAllItems] = useState();
    const [errors, setErrors] = useState(null);

    /* fetch items */
    useEffect(() => {
        let ignored = false
        async function fetchItems() {
            try {
                const resp = await axios.get('/api/fetchItems', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                })

                if (resp.status === 200) {
                    setAllItems(resp.data)
                    setIsLoading(false)
                } else {
                    setIsLoading(false);
                    toast.error('Oops!! Unknown error occurred, try again later.')
                }
            } catch (error) {
                if (error.response) {
                    setErrors(error.response.data.message)
                } else {
                    toast.error(error.message)
                }
            }
        }

        if (!ignored) {
            fetchItems();
        }

        return () => {
            ignored = true;
        }
    }, [])

    const handleCheck = (id) => {
        const item = allItems.find(el => el.id === id);

        if (checkedIds.includes(item.id)) {
            setCheckedIds(prev => prev.filter(i => i !== item.id));
            setItems(prev => prev.filter(it => it.id !== item.id));
            return;
        }

        setCheckedIds([...checkedIds, item.id])
        setItems([...items, item])
    }

    function itemQuantityChange(id, val) {
        return setItems(prevItems => prevItems.map(itm => {
            if (itm.id === id) {
                itm.qty = val;
            }

            return itm;
        }));
    }

    const handleSubmit = async () => {
        setIsLoading(true);
        try {
            const resp = await axios.post('/api/validate-packing-unpacking-items', { items }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
            })

            setIsLoading(false);
            setErrors(null);
            if (resp.status === 200) {
                localStorage.setItem('packingUnpackingItems', JSON.stringify(items));
                next();
            } else {
                toast.error('Oops!! Unable to complete submission, try again later.')
            }
        } catch (error) {
            setIsLoading(false);
            if (error.response.status === 422) {
                setErrors(Object.values(error.response.data.errors));
            } else {
                setErrors([error.message]);
            }
        }
    }

    if (isLoading) {
        return <div className='w-full h-[80vh] flex items-center justify-center'>
            <ClipLoader size={34} color='blue' />
        </div>
    }

    return (
        <div>
            <ToastContainer />
            <div className="mt-10 relative w-full max-w-4xl mx-auto text-center">
                <button onClick={() => setIsOpen(!isOpen)} className="group w-full max-w-xl mx-auto px-6 py-3 border-2 border-gray-300 rounded-lg dark:border-gray-600 text-gray-800 dark:text-gray-100 uppercase font-semibold inline-flex justify-between items-center">
                    <span>pick your items</span>
                    {
                        isOpen ? <FaAngleDown className='rotate-180 transition ease-in-out group-hover:-translate-y-1' /> :
                            <FaAngleDown className='transition ease-in-out group-hover:translate-y-1' />
                    }
                </button>
                {
                    isOpen && <div className='px-3 absolute w-full max-w-xl top-full mt-2 z-10 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-500 rounded-xl h-auto max-h-[85vh] overflow-y-scroll'>
                        <div className="sticky top-0 py-3 bg-inherit flex justify-between items-center text-gray-400 dark:text-gray-400">
                            <h5 className='text-md capitalize'>All items</h5>
                            <button
                                onClick={() => setIsOpen(false)}
                                className="inline-flex items-center justify-center size-10 rounded-full bg-inherit hover:bg-gray-950">
                                <BiCollapseAlt className='size-7 cursor-pointer transition ease-in-out hover:size-6 duration-300' />
                            </button>
                        </div>
                        <ul role='listbox' className="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                            {
                                allItems.length > 0 && allItems.map(item => <li key={item.id} className='cursor-pointer flex items-center gap-4 flex-nowrap py-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 pl-2'>
                                    <input
                                        type="checkbox"
                                        checked={checkedIds.includes(item.id)}
                                        id={item.id}
                                        className='rounded size-7 border bg-inherit'
                                        onChange={() => handleCheck(item.id)}
                                    />
                                    <Label val={item.name} htmlFor={item.id} />
                                </li>)
                            }
                        </ul>
                        <div className='mt-3 py-3 border-t border-gray-200 dark:border-gray-700'>
                            <button
                                onClick={() => {
                                    setCheckedIds([]);
                                    setItems([]);
                                    setIsOpen(false);
                                }}
                                className="outline-none border-0 text-sm font-semibold text-gray-700 dark:text-gray-400 inline-flex items-center gap-3">
                                <span>clear all</span>
                                <IoClose className='size-7' />
                            </button>
                        </div>
                    </div>
                }
            </div>
            <div className="mt-10 w-full max-w-4xl mx-auto overflow-x-hidden">
                <div className="overflow-x-auto">
                    <table className="w-full table table-responsive table-auto">
                        <thead>
                            <tr className='border-0 border-b border-gray-300 dark:border-gray-500'>
                                <th className="text-center p-2 text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">Items</th>
                                <th className="text-center p-2 text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">Units</th>
                                <th className="text-center p-2 text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                items.length > 0 && items.map(element => <tr key={element.id} className='border-0 border-b border-gray-200 dark:border-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800'>
                                    <td className="text-center p-2 text-md capitalize text-gray-800 dark:text-gray-200">{element.name}</td>
                                    <td className="text-center p-2 text-md capitalize text-gray-800 dark:text-gray-200">
                                        {
                                            element.qty !== null ? <input
                                                type="number"
                                                min={1}
                                                value={element.qty}
                                                onChange={(e) => itemQuantityChange(element.id, e.target.value)}
                                                onBlur={(e) => {
                                                    if (e.target.value === '' || parseInt(e.target.value, 10) < 1) {
                                                        itemQuantityChange(element.id, '1'); // Reset empty or negative value to 1
                                                    }
                                                }}
                                                onKeyDown={(e) => {
                                                    if (e.key === '-' || e.key === 'e') {
                                                        e.preventDefault(); // Prevent negative sign and scientific notation
                                                    }
                                                }}
                                                className='inline mx-auto w-16 bg-transparent rounded-lg px-2 py-1 border border-gray-200 dark:border-gray-700 focus:border-indigo-300 dark:focus:border-blue-300' /> :
                                                <span>----</span>
                                        }
                                    </td>
                                    <td className="text-center p-2 text-md capitalize text-gray-800 dark:text-gray-200">
                                        <button onClick={() => handleCheck(element.id)} className="size-10 rounded-full hover:bg-rose-100 inline-flex items-center justify-center">
                                            <IoClose className='size-7 text-rose-800' />
                                        </button>
                                    </td>
                                </tr>)
                            }
                        </tbody>
                    </table>
                </div>
            </div>
            {
                errors && <ul className='py-4'>
                    {
                        (errors).map((err, idx) => <li key={idx} className='text-sm text-rose-600 font-medium md:text-center'>{err}</li>)
                    }
                </ul>
            }
            <div className="flex flex-col gap-4 items-center mt-10 lg:mt-14">
                <PrimaryButton
                    disabled={items.length === 0}
                    onClick={handleSubmit}
                    id="submitStep2"
                    type="submit"
                    className="w-3/5 disabled:bg-indigo-800">
                    <span>next step</span>
                </PrimaryButton>
                <button
                    onClick={() => {
                        if (items.length > 0) localStorage.setItem('packingUnpackingItems', JSON.stringify(items));
                        prev();
                    }}
                    className="hover:underline outline-none border-0 text-sm font-semibold text-gray-700 dark:text-gray-400 inline-flex items-center gap-3">
                    <FaArrowLeft className='size-7' />
                    <span>Go back</span>
                </button>
            </div>
        </div>
    )
}
