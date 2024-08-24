import React, { useEffect } from 'react'
import { Navigate, Outlet, useNavigate } from 'react-router-dom'
import { useStateContext } from '../contexts/context'
import Toast from '../components/Toast'

export default function GuestLayout() {
    const {userToken, currentUser} = useStateContext()
    //fecth /me
    // useEffect(() => {},[])

  

    if (userToken) {
      if (currentUser === 'admin') {
        return <Navigate to='/dashboard' />;
      }
      if (currentUser === 'user' || currentUser === 'admin') {
        return <Navigate to='/game' />;
      }
    }
  
  return (
    <div>
        <Toast/>
        <Outlet/>
        
    </div>
  )
}
