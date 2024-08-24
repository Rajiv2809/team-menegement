import React, { useEffect, useState } from 'react';
import axiosClient from '../axios';

export default function ListSquad() {
  const [squads, setSquads] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axiosClient.get('/team-squad').then(({ data }) => {
      setSquads(data.teamSquad);
    
      setLoading(false);
    }).catch((err) => {
      console.log(err.response.data.message);
    });
  }, []);

  return (
    <>
    <section className='h-[100vh] bg-[#333]'>

      <div className='w-full sm:w-[800px] text-[#40D3DC] py-12 text-4xl mx-auto'>
        SQUADS
      </div>

      {!loading && squads.length > 0 && squads.map((item, index) => (
        <ul key={index} className="bg-white mt-2    sm:w-[800px] h-[120px] shadow overflow-hidden sm:rounded-md mx-auto">
          <li className="border-t border-gray-200 mx-2">
            <div className="px-4 py-5 sm:px-6">
              <div className="flex items-center justify-between">
                <h3 className="text-lg leading-6 font-medium text-gray-900">{item.squadName}</h3>
                <p className="mt-1 max-w-2xl text-sm text-gray-500">{item.description}</p>
              </div>
              <div className="mt-4 flex items-center justify-between">
                <p className="text-sm font-medium text-gray-500">Achievement: <span className="text-red-600"> {item.achievement}</span></p>
                <a href="#" className="font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
              </div>
            </div>
          </li>
        </ul>
      ))}
    </section>
    </>
  );
}
