import { createBrowserRouter, Navigate } from "react-router-dom";

//views
import GuestLayout from "./views/GuestLayout";
import DefaultLayout from "./views/DefaultLayout";


//pages
import Login from "./pages/Login";
import Register from "./pages/Register";
import Home from "./pages/Home"
import Users from "./pages/Users";
import Game from "./pages/Game"

const router  = createBrowserRouter([
    
        {
            path: '/',
            element: <GuestLayout/>,
            children: [
                {
                    path:'/',
                    element: <Navigate to='/home'/>
                },
                
                {
                    path:'/login',
                    element: <Login/>
                },
                {
                    path:'/register',
                    element: <Register/>
                }
            ]
        },
        {
            path: '/',
            element: <DefaultLayout/>,
            children: [
                {
                    path:'/',
                    element: <Navigate to='/dashboard'/>
                },
                {
                    path:'/dashboard',
                    element: <Home/>
                },
                {
                    path:'/users',
                    element:<Users/>
                },
                {
                    path:'/game',
                    element: <Game/>
                },
            ]
        }
])
export default router;  