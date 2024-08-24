import React, { useState } from 'react'
import Banner from '../components/Banner'
import ListSquad from '../components/LIstSquad'
import  Navigation from '../components/Navigation'
import '../style/style.css'
import { useStateContext } from '../contexts/context'
export default function Home() {
  const {currentUser} = useStateContext();
  

  return (
  <>
    <div>
      <Navigation/>
      <Banner/>
      <ListSquad/>
    </div>
  </>
  )
}
