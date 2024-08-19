import React, { useState } from 'react';
import axiosClient from '../axios';
import { useStateContext } from '../contexts/context';
import { useNavigate } from 'react-router-dom';

export default function Register() {
    const [name, setName] = useState('');
    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [dateOfBirth, setDateOfBirth] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const [profilePicture, setProfilePicture] = useState(null);
    const {showToast} = useStateContext();
    const navigate = useNavigate();
    const onSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('name', name);
        formData.append('username', username);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('dateOfBirth', dateOfBirth);
        formData.append('phoneNumber', phoneNumber);
        if (profilePicture) {
            formData.append('profilePicture', profilePicture);
        }

        axiosClient.post('/register', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then(({ data }) => {
            showToast(data.message);
            navigate('/login')
        })
        .catch((err) => {
            showToast(err.response.data.message)
        });
    };

    return (
        <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div className="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 className="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Create Account
                </h2>
            </div>

            <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-[800px]">
                <form onSubmit={onSubmit} className="gap-2 grid md:grid-cols-2">
                    <div>
                        <label htmlFor="name" className="block text-sm font-medium leading-6 text-gray-900">
                            Name
                        </label>
                        <div className="mt-2">
                            <input
                                id="name"
                                name="name"
                                required
                                value={name}
                                onInput={e => setName(e.target.value)}
                                autoComplete="name"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label htmlFor="username" className="block text-sm font-medium leading-6 text-gray-900">
                            Username
                        </label>
                        <div className="mt-2">
                            <input
                                id="username"
                                name="username"
                                required
                                value={username}
                                onInput={e => setUsername(e.target.value)}
                                autoComplete="username"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label htmlFor="email" className="block text-sm font-medium leading-6 text-gray-900">
                            Email
                        </label>
                        <div className="mt-2">
                            <input
                                id="email"
                                name="email"
                                required
                                value={email}
                                onInput={e => setEmail(e.target.value)}
                                autoComplete="email"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label htmlFor="password" className="block text-sm font-medium leading-6 text-gray-900">
                            Password
                        </label>
                        <div className="mt-2">
                            <input
                                id="password"
                                name="password"
                                required
                                value={password}
                                onInput={e => setPassword(e.target.value)}
                                autoComplete="password"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label htmlFor="phoneNumber" className="block text-sm font-medium leading-6 text-gray-900">
                            Phone Number 
                        </label>
                        <div className="mt-2">
                            <input
                                id="phoneNumber"
                                name="phoneNumber"
                                type="number"
                                required
                                value={phoneNumber}
                                onInput={e => setPhoneNumber(e.target.value)}
                                autoComplete="phoneNumber"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <label htmlFor="dateOfBirth" className="block text-sm font-medium leading-6 text-gray-900">
                            Date Of Birth
                        </label>
                        <div className="mt-2">
                            <input
                                id="dateOfBirth"
                                name="dateOfBirth"
                                type="date"
                                required
                                value={dateOfBirth}
                                onInput={e => setDateOfBirth(e.target.value)}
                                autoComplete="dateOfBirth"
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div className="col-span-2">
                        <label htmlFor="profilePicture" className="block text-sm font-medium leading-6 text-gray-900">
                            Profile Picture
                        </label>
                        <div className="mt-2">
                            <input
                                id="profilePicture"
                                name="profilePicture"
                                type="file"
                                required
                                onChange={e => setProfilePicture(e.target.files[0])}
                                className="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div className="">
                        <button
                            type="submit"
                            className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Sign Up
                        </button>
                    </div>
                </form>

                <p className="mt-10 text-center text-sm text-gray-500">
                    Already have an account?{' '}
                    <a href="/login" className="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                        Login
                    </a>
                </p>
            </div>
        </div>
    );
}
