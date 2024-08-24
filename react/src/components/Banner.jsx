import React, { useEffect, useState } from 'react'
import axiosClient from '../axios';

export default function Banner() {
    const [banners, setBanners] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axiosClient.get('/banner')
            .then(({ data }) => {
                setBanners(data.banner);
                setLoading(false);
            })
            .catch((err) => {
                console.log(err.response.data.message);
            });
    }, []);

    return (
        <>
            <div className="banner-header">

                <div className="slider">
                    <div className="slides">

                        {!loading && banners.length > 0 && banners.map((item, index) => (
                            <input key={index} type="radio" name="radio-btn" id={`radio${index + 1}`} />
                        ))}

                        {!loading && banners.length > 0 && banners.map((item, index) => (
                            <div key={index} className={`slide ${index === 0 ? 'first' : ''}`}>
                                <img src={`http://127.0.0.1:8000/storage/${item.bannerImage}`} alt="" />
                            </div>
                        ))}

                        <div className="navigation-auto">
                            {!loading && banners.length > 0 && banners.map((item, index) => (
                                <div key={index} className={`auto-btn${index + 1}`}></div>
                            ))}
                        </div>

                    </div>

                    <div className="navigation-manual">
                        {!loading && banners.length > 0 && banners.map((item, index) => (
                            <label key={index} htmlFor={`radio${index + 1}`} className="manual-btn"></label>
                        ))}
                    </div>

                </div>
            </div>
        </>
    );
}
