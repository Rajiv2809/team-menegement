import React from 'react'
import { useStateContext } from '../contexts/context';

export default function Game() {
  const {currentUser} = useStateContext();
  console.log(currentUser.role);
  
  return (
    <div>Game</div>
  )
}
