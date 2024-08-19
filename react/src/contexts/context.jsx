import { createContext, useState , useContext} from "react";

const StateContext = createContext({
    currentUser : {},
    userToken : null,
    toast: {
        message: '', 
        color : '',
        show: false
    },
    setCurrentUser : () => {},
    setToken : () => {},
    setToast  : () => {},
})
export const ContextProvider = ({children}) => {
    const [currentUser, setCurrentUser] = useState({});
    const [ userToken, setUserToken] = useState(localStorage.getItem('accessToken'));
    const [toast, setToast] = useState({message:'', color:'', show:false})
    const setToken = (token) => {
        if(token){
            localStorage.setItem('accessToken', token)
        }
        else{
            localStorage.removeItem('accessToken')
        }
        setCurrentUser(token)
    }
    const showToast = (message, color) => {
        setToast({
            message: message,
            color: color,
            show:true
        })

        setTimeout(() => {
            setToast({
                message: '',
                color: '',
                show:false
            })
        }, 3000)
    }
    return (
        <StateContext.Provider
            value={{ 
                currentUser,
                userToken,
                toast,
                setToast,
                setToken,
                setCurrentUser,
                setUserToken,
                showToast,
            }}
        >
            {children}
        </StateContext.Provider>
    )

}
export const useStateContext = () => useContext(StateContext);