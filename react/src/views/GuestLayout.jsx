import React, { useEffect } from 'react'
import { Navigate, Outlet, useNavigate } from 'react-router-dom'
import { useStateContext } from '../contexts/context'
import Toast from '../components/Toast'

export default function GuestLayout() {
    const {userToken} = useStateContext()



    if(userToken){
      // setTimeout(() => {
      //   window.location.reload();
      // }, 3000)
      return <Navigate to='/home'/>
    }
  return (
    <div>
        <Toast/>
        <Outlet/>
        
    </div>
  )
}
