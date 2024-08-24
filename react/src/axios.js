import axios from "axios";

const URL = 'http://127.0.0.1:8000/api';

const axiosClient = axios.create({
    baseURL: URL
});

// Add interceptors for requests
axiosClient.interceptors.request.use(config => {
    const token = localStorage.getItem('accessToken');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`; // Correct Bearer format
    }
    return config;
});

// Add interceptors for responses
axiosClient.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated') {
            localStorage.removeItem('accessToken');
            window.location.reload();
        }
        return Promise.reject(error);
    }
);

export default axiosClient;
