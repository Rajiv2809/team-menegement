import React from 'react'
import logo from '../assets/image/letter_s_with_star_logo__very_creative-removebg-preview.png'
export default function Navigation() {


    const onLogout = (e) => {
      localStorage.removeItem('accessToken');
      window.location.reload();

    }

  return (
    <>
    <header>
      <img className='w-24 h-[80px]' src={logo} alt=""/>
            <input type="checkbox" id="menu-bar"/>
              <label for="manu-bar">Menu</label>
              <nav class="navbar h-full justify-center item-center ">
                <ul>
                  <li><a href="/home">home</a></li>
                  <li><a href="/users">users</a></li>
                  <li><a href="#">gallery</a></li>
                  <li onClick={onLogout}><a href="#">logout</a></li>
                </ul>
              </nav>
    </header>
        
    </>
  )
}
