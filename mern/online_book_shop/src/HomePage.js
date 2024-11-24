import React from 'react';
import { Link } from 'react-router-dom';

const HomePage = () => (
    <div>
        <h1>Welcome to Online Book Store</h1>
        <Link to="/login">Login</Link> | <Link to="/register">Register</Link> | <Link to="/catalogue">Catalogue</Link>
    </div>
);

export default HomePage;
