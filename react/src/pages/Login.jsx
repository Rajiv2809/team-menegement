import React, { useState } from 'react'
import axiosClient from '../axios'
import { useStateContext } from '../contexts/context';
import { useNavigate } from 'react-router-dom';
import ReCAPTCHA from 'react-google-recaptcha';
export default function Login() {
    const { setToken, showToast, setCurrentUser } = useStateContext();
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [captchaToken, setCaptchaToken] = useState(null);
    const navigate = useNavigate();
    const submit = (e) => {
        e.preventDefault()
        axiosClient.post('/login', {
            username: username,
            password: password,
            recaptcha: captchaToken
        }
        ).then(({ data }) => {
            setToken(data.token);
            showToast(data.message);
            setCurrentUser(data.user)
            navigate('/home')
        }).catch(({ err }) => {
            showToast(err.response.data.message, 'red')
        })



    }
    const onCaptchaChange = (token) => {
        setCaptchaToken(token);
    };

    return (
        <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div className="sm:mx-auto sm:w-full sm:max-w-sm">

                <h2 className="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Sign in to your account
                </h2>
            </div>

            <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form onSubmit={submit} className="space-y-6">
                    <div>
                        <label htmlFor="usernmae" className="block text-sm font-medium leading-6 text-gray-900">
                            Usernmae address
                        </label>
                        <div className="mt-2">
                            <input
                                id="usernmae"
                                name="usernmae"

                                required
                                value={username}
                                onInput={e => setUsername(e.target.value)}
                                autoComplete="usernmae"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div>
                        <div className="flex items-center justify-between">
                            <label htmlFor="password" className="block text-sm font-medium leading-6 text-gray-900">
                                Password
                            </label>
                        </div>
                        <div className="mt-2">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                value={password}
                                onInput={e => setPassword(e.target.value)}
                                autoComplete="current-password"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <ReCAPTCHA
                            sitekey="6LcyqyMqAAAAAN5Pb9ps0ytj9AdEKh-rM12_lbVi" 
                            onChange={onCaptchaChange}
                        />
                    </div>

                    <div>
                        <button
                            type="submit"
                            className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Sign in
                        </button>
                    </div>
                </form>

                <p className="mt-10 text-center text-sm text-gray-500">
                    don't have an account?{' '}
                    <a href="/register" className="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                        register
                    </a>
                </p>
            </div>
        </div>
    )
}
