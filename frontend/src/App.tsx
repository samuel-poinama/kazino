import './App.css'

function App() {

  return (
    <div className="h-screen w-screen bg-[url('public/file.jpg')] bg-cover bg-center flex flex-col justify-between">
      {/* Conteneur centré */}
      <div className="flex-grow flex items-center justify-center">
        <div
          className="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 bg-white/70 rounded-lg flex items-center justify-center cursor-pointer shadow-lg"
          onClick={handleClick}
        >
          <img
            src="/public/chip.jpg"
            alt="Placeholder"
            className="w-20 h-20 sm:w-28 sm:h-28 lg:w-32 lg:h-32 object-contain"
          />
        </div>
      </div>

      {/* Score en bas */}
      <div className="text-center pb-8">
        <p className="text-white text-lg sm:text-xl lg:text-2xl font-semibold">Score: 0</p>
      </div>
    </div>
  );
};

function handleClick() {
  console.log("ta mere")
return ""
};
export default App