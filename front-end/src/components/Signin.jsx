import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { signin } from '../services/auth';
import './Auth.css';

const Signin = () => {
    const [formData, setFormData] = useState({ email: '', password: '' });
    const [message, setMessage] = useState({ error: '', success: '' });

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
        setMessage({ error: '', success: '' });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await signin(formData);
            setMessage({ error: '', success: response.message || 'Signin successful!' });
            localStorage.setItem('auth_token', response.token);
        } catch (error) {
            setMessage({ error: error.message || 'Invalid credentials!', success: '' });
        }
    };

    return (
        <div className="auth-container">
            <form className="auth-form" onSubmit={handleSubmit}>
                <h2>Login</h2>
                {message.error && <p className="error-message">{message.error}</p>}
                {message.success && <p className="success-message">{message.success}</p>}
                <input type="email" name="email" placeholder="Email" value={formData.email} onChange={handleChange} required />
                <input type="password" name="password" placeholder="Password" value={formData.password} onChange={handleChange} required />
                <button type="submit">Sign In</button>
                <p>
                    Don't have an account? <Link to="/signup">Sign up</Link>
                </p>
            </form>
        </div>
    );
};

export default Signin;
