import React from 'react'
import { Outlet , Navigate} from 'react-router-dom'
import { useStateContext } from '../contexts/context'
import Toast from '../components/Toast'

export default function DefaultLayout() {
    const {userToken} = useStateContext()

    if(!userToken){
        return <Navigate to='/login'/>
    }
  return (
    <div>
        <Toast/>
        <Outlet/>

    </div>
  )
}
