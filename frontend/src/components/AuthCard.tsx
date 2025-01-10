import React, { useState } from "react";
import "../styles/AuthCard.css";

interface AuthCardProps {
  onLogin: (email: string, password: string) => Promise<void>;
  onRegister: (name: string, email: string, password: string) => Promise<void>;
}

const AuthCard: React.FC<AuthCardProps> = ({ onLogin, onRegister }) => {
  const [isRegister, setIsRegister] = useState(false);
  const [loginData, setLoginData] = useState({ email: "", password: "" });
  const [registerData, setRegisterData] = useState({
    name: "",
    email: "",
    password: "",
  });
  const [error, setError] = useState("");

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      setError("");
      await onLogin(loginData.email, loginData.password);
    } catch (err) {
      setError("Failed to login. Please try again.");
    }
  };

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      setError("");
      await onRegister(registerData.name, registerData.email, registerData.password);
    } catch (err) {
      setError("Failed to register. Please try again.");
    }
  };

  return (
    <div className="h-screen w-screen">
    <div className="wrapper">
      <div className="card-switch">
        <label className="switch">
          <input
            type="checkbox"
            className="toggle"
            checked={isRegister}
            onChange={() => setIsRegister(!isRegister)}
          />
          <span className="slider"></span>
          <span className="card-side"></span>
          <div className="flip-card__inner">
            {/* Login Form */}
            <div className="flip-card__front">
              <div className="title">Log in</div>
              <form className="flip-card__form" onSubmit={handleLogin}>
                <input
                  className="flip-card__input"
                  name="email"
                  placeholder="Email"
                  type="email"
                  value={loginData.email}
                  onChange={(e) => setLoginData({ ...loginData, email: e.target.value })}
                />
                <input
                  className="flip-card__input"
                  name="password"
                  placeholder="Password"
                  type="password"
                  value={loginData.password}
                  onChange={(e) => setLoginData({ ...loginData, password: e.target.value })}
                />
                <button className="flip-card__btn" type="submit">
                  Let&apos;s go!
                </button>
              </form>
            </div>

            {/* Register Form */}
            <div className="flip-card__back">
              <div className="title">Sign up</div>
              <form className="flip-card__form" onSubmit={handleRegister}>
                <input
                  className="flip-card__input"
                  placeholder="Name"
                  type="text"
                  value={registerData.name}
                  onChange={(e) => setRegisterData({ ...registerData, name: e.target.value })}
                />
                <input
                  className="flip-card__input"
                  name="email"
                  placeholder="Email"
                  type="email"
                  value={registerData.email}
                  onChange={(e) => setRegisterData({ ...registerData, email: e.target.value })}
                />
                <input
                  className="flip-card__input"
                  name="password"
                  placeholder="Password"
                  type="password"
                  value={registerData.password}
                  onChange={(e) => setRegisterData({ ...registerData, password: e.target.value })}
                />
                <button className="flip-card__btn" type="submit">
                  Confirm!
                </button>
              </form>
            </div>
          </div>
        </label>
      </div>
      {error && <div className="error-message">{error}</div>}
    </div></div>
  );
};

export default AuthCard;
