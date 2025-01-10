import './App.css';
import React, { useState } from 'react';
import StorePage from './components/StorePage';

function App() {
  const [isStoreOpen, setIsStoreOpen] = useState(false);

  const openStore = () => setIsStoreOpen(true);
  const closeStore = () => setIsStoreOpen(false);

  return (
    <div className="h-screen w-screen bg-[url('public/BG.png')] bg-cover bg-center flex flex-col">
      {/* Bouton pour ouvrir le store */}
      <div className="absolute top-4 right-4">
        <button
          onClick={openStore}
          className="bg-teal-500 hover:bg-teal-600 text-white py-2 px-4 rounded-md text-lg font-bold shadow-md"
        >
          Open Store
        </button>
      </div>

      {/* Conteneur principal */}
      <div className="flex-grow flex items-center justify-center">
        <div
          className="mt-8 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 /70 rounded-lg flex items-center justify-center cursor-pointer shadow-lg z"
          onClick={handleClick}
        >
          <img
            src="/public/chip.png"
            alt="Placeholder"
            className="w-20 h-20 sm:w-28 sm:h-28 lg:w-32 lg:h-32 object-contain"
          />
        </div>
      </div>

      {/* Score en bas */}
      <div className="text-center py-4">
        <p className="text-white text-lg sm:text-xl lg:text-2xl font-semibold outline-1">Score: 0</p>
      </div>

      {/* Store Page */}
      <StorePage isOpen={isStoreOpen} onClose={closeStore} />
    </div>
  );
}

function handleClick() {
  console.log('Div cliquée');
}

export default App;
