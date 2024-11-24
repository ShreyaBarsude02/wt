import React, { useState } from 'react';

const LoginPage = ({ setUser }) => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            const response = await fetch('http://localhost:5000/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password }),
            });
            const user = await response.json();
            if (!response.ok) throw new Error(user.message || 'Login failed');
            setUser(user);
        } catch (err) {
            alert(err.message);
        }
    };

    return (
        <form onSubmit={handleLogin}>
            <h2>Login</h2>
            <input type="email" placeholder="Email" onChange={(e) => setEmail(e.target.value)} required />
            <input type="password" placeholder="Password" onChange={(e) => setPassword(e.target.value)} required />
            <button type="submit" onSubmit={handleLogin}>Login</button>
        </form>
    );
};

export default LoginPage;
