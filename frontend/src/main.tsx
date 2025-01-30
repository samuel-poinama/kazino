import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router";
import App from "./App.tsx";
import './index.css'
import Login from "./components/Login.tsx";
import Register from "./components/Register.tsx";
// import ResetPassword from "./components/ResetPassword.tsx";
// import PrivateRoute from "./components/PrivateRoute.tsx";

const root = document.getElementById("root");

if (root) {
  ReactDOM.createRoot(root).render(
    <BrowserRouter>
      <Routes>
        <Route path="/login" element={<Login />} />
        {/* <privateRoute path="/" element={<App />} /> */}
        <Route path="/" element={<App />} />
        <Route path="/register" element={<Register />} />
        {/* <Route path="*" element={<h1>404 Not Found</h1>} /> */}
        {/* <Route path="/forgot-password" element={<ResetPassword/>} /> */}
      </Routes>
    </BrowserRouter>
  );
} else {
  console.error("Root element not found");
}