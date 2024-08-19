import axios from "axios";

const  URL = 'http://127.0.0.1:8000/api'
const axiosClient = axios.create({
    baseURL : URL
});

axiosClient.interceptors.request.use(config => {
    config.params = {
        token : localStorage.getItem('accessToken')
    }
    return config;
})
axiosClient.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401 && error.response.message === 'Unauthorized user'){
            localStorage.removeItem('accessToken')
            window.location.reload()
        }
        
    }
    
)
export default axiosClient