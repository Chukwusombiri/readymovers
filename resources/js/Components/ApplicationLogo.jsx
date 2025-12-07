import React, { use } from 'react'
import logo from '../../images/logo.png';
import { useAppContext } from '../Contexts/GeneralContextProvider';

export default function ApplicationLogo({ classList='' }) {
  const {isDark} = useAppContext();
  return (
    <img src={logo} alt="App Logo" className={classList} />
  )
}
