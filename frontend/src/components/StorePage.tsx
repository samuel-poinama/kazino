import React, { useState } from "react";

const StorePage = ({ isOpen, onClose }) => {
  const [balance, setBalance] = useState(5000); // Simulated LXP balance
  const [selectedItem, setSelectedItem] = useState(null);

  const products = [
    { id: 1, name: "Auto Miner", description: "Mines automatically.", price: 1500, image: "Cchip.svg" },
    { id: 2, name: "Double LXP", description: "Earn double points!", price: 2000, image: "Cstonk.svg" },
    { id: 3, name: "Speed Boost", description: "Click faster!", price: 1200, image: "Cblock.svg" },
  ];

  const openModal = (item) => {
    setSelectedItem(item);
  };

  const closeModal = () => {
    setSelectedItem(null);
    onClose();
  };

  const handlePurchase = () => {
    if (selectedItem && balance >= selectedItem.price) {
      setBalance(balance - selectedItem.price);
      alert(`${selectedItem.name} purchased!`);
      closeModal();
    } else {
      alert("Insufficient LXP.");
    }
  };

  if (!isOpen) return null;

  return (
    <div
      className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
      onClick={closeModal}
    >
      <div
        className="bg-blue-800 p-8 rounded-lg shadow-lg w-4/5 h-4/5 relative overflow-y-auto"
        onClick={(e) => e.stopPropagation()}
      >
        <header className="p-4 bg-blue-900 shadow-md flex justify-between items-center rounded-md">
          <h1 className="text-2xl font-bold text-white">Autoclicker Store</h1>
          <div className="text-lg text-white">
            LXP Balance: <span className="font-bold">{balance}</span>
          </div>
        </header>
        <main className="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {products.map((product) => (
            <div
              key={product.id}
              className="bg-blue-700 p-4 rounded-lg shadow-md flex flex-col items-center">
              <img
                src={product.image}
                alt={product.name}
                className="w-24 h-24 object-cover mb-4"
              />
              <h2 className="text-lg font-bold text-white mb-2">{product.name}</h2>
              <p className="text-sm text-gray-300 mb-2">{product.description}</p>
              <p className="text-lg font-bold text-white mb-4">{product.price} LXP</p>
              <button
                onClick={() => openModal(product)}
                className="bg-teal-500 hover:bg-teal-600 text-white py-2 px-4 rounded-md">
                Buy
              </button>
            </div>
          ))}
        </main>

        {selectedItem && (
          <div className="mt-4 bg-blue-700 p-4 rounded-lg">
            <h2 className="text-xl font-bold text-white mb-4">{selectedItem.name}</h2>
            <p className="text-gray-300 mb-4">{selectedItem.description}</p>
            <p className="mb-4 text-white">
              Price: <span className="font-bold">{selectedItem.price} LXP</span>
            </p>
            <p className="mb-4 text-white">
              Your Balance: <span className="font-bold">{balance} LXP</span>
            </p>
            <div className="flex justify-end gap-4">
              <button
                onClick={closeModal}
                className="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md">
                Cancel
              </button>
              <button
                onClick={handlePurchase}
                className="bg-teal-500 hover:bg-teal-600 text-white py-2 px-4 rounded-md">
                Confirm
              </button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default StorePage;
