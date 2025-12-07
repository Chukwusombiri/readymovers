import React, { useState } from 'react'
import Input from './Input';
import Label from './Label';
import PrimaryButton from './PrimaryButton';
import { FaArrowLeft } from 'react-icons/fa6';
import Validator from '../Utils/Validator';
import { toast, ToastContainer } from 'react-toastify';
import ClipLoader from 'react-spinners/ClipLoader';

const validator = new Validator();

export default function PackingAndUnPackingUserInfo({ next, prev }) {
  const storedUserInfo = JSON.parse(localStorage.getItem('packingUnpackingUserInfo')) || {
    username: '',
    email: '',
    phone: '',
  }
  const [userInfo, setUserInfo] = useState(storedUserInfo);
  const [errors, setErrors] = useState({});
  const [isLoading, setIsLoading] = useState(false);

  const validateInput = (prop, data) => {
    if (!validator.isStr(data)) {
      setErrors({ ...errors, [prop]: validator.str });
      return;
    }

    if (!validator.hasMinStr(data, 7)) {
      setErrors({ ...errors, [prop]: validator.minStr() });
      return;
    }

    if (prop === 'email' && !validator.isEmail(data)) {
      setErrors({ ...errors, [prop]: validator.email });
      return;
    }

    if (prop === 'phone' && !validator.isPhoneNumber(data)) {
      setErrors({ ...errors, [prop]: validator.phone });
      return;
    }

    setErrors(prevErrors => {
      let newErrors = {};
      for (const key in prevErrors) {
        if (key !== prop) {
          newErrors[key] = prevErrors[key];
        }
      }

      return newErrors
    })
  }

  async function handleSubmit(evt) {
    evt.preventDefault();
    setIsLoading(true);
    try {
      const jsonResp = await fetch('/api/packing-unpacking-validate-user-info', {
        method: 'post',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(userInfo),
      });

      const resp = await jsonResp.json();
      setErrors({});
      setIsLoading(false);
      toast.success(resp.message);
      setTimeout(() => {
        localStorage.setItem('packingUnpackingUserInfo', JSON.stringify(userInfo));
        next();
      }, 2000)
    } catch (error) {
      setIsLoading(false);
      if (error.response) {
        setErrors(error.response)
      } else {
        toast.error(error.message);
      }
    }
  }

  if (isLoading) {
    return (<div className='w-full h-[60vh] flex items-center justify-center'>
      <ClipLoader className='size-20' color='blue' />
    </div>)
  }

  return (
    <div className=''>
      <ToastContainer />
      <form onSubmit={handleSubmit}>
        <div className="w-full max-w-xl mx-auto space-y-4 mt-10">
          <div className="flex flex-col gap-1">
            <Label htmlFor="username" val={'Your full name'} />
            <Input type="text"
              onChange={(e) => setUserInfo({ ...userInfo, username: e.target.value })}
              onBlur={e => validateInput('username', e.target.value)}
              value={userInfo.username} id="username" required />
            {errors?.username && <p className='text-rose-600 text-xs mt-1'>{errors.username}</p>}
          </div>
          <div className="flex flex-col gap-1">
            <Label htmlFor="email" val={'Your email'} />
            <Input type="text"
              onChange={(e) => setUserInfo({ ...userInfo, email: e.target.value })}
              onBlur={e => validateInput('email', e.target.value)}
              value={userInfo.email} id="email" required />
            {errors?.email && <p className='text-rose-600 text-xs mt-1'>{errors.email}</p>}
          </div>
          <div className="flex flex-col gap-1">
            <Label htmlFor="phone" val={'Your Phone number'} />
            <Input type="text"
              onChange={(e) => setUserInfo({ ...userInfo, phone: e.target.value })}
              onBlur={e => validateInput('phone', e.target.value)}
              value={userInfo.phone} id="phone" required />
            {errors?.phone && <p className='text-rose-600 text-xs mt-1'>{errors.phone}</p>}
          </div>
        </div>

        <div className="flex flex-col gap-4 items-center mt-10 lg:mt-14">
          <PrimaryButton
            disabled={(Object.keys(errors)).length > 0}
            onClick={handleSubmit}
            id="submitStep3"
            type="submit"
            className="w-3/5 disabled:bg-indigo-800">
            <span>complete</span>
          </PrimaryButton>
          <button
            onClick={() => {
              localStorage.setItem('userInfo', JSON.stringify(userInfo));
              prev()
            }}
            className="hover:underline outline-none border-0 text-sm font-semibold text-gray-700 dark:text-gray-400 inline-flex items-center gap-3">
            <FaArrowLeft className='size-7' />
            <span>Go back</span>
          </button>
        </div>
      </form>
    </div>
  )
}
