import { createBrowserRouter, Navigate } from "react-router-dom";

//views
import GuestLayout from "./views/GuestLayout";
import DefaultLayout from "./views/DefaultLayout";


//pages
import Login from "./pages/Login";
import Register from "./pages/Register";
import Home from "./pages/Home"

const router  = createBrowserRouter([
    
        {
            path: '/',
            element: <GuestLayout/>,
            children: [
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
                    element: <Navigate to='/home'/>
                },
                {
                    path:'/home',
                    element: <Home/>
                }
            ]
        }
])
export default router;