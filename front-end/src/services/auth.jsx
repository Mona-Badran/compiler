// src/services/auth.js

import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000', // Ensure this matches your backend URL
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

// Signup function
export const signup = async (userData) => {
    try {
        const response = await api.post('/register', userData);
        return response.data;
    } catch (error) {
        // Handle error appropriately
        throw error.response?.data || error.message;
    }
};

// Signin function
export const signin = async (credentials) => {
    try {
        const response = await api.post('/login', credentials);
        if (response.data.token) {
            localStorage.setItem('auth_token', response.data.token); // Consistent key
        }
        return response.data;
    } catch (error) {
        // Handle error appropriately
        throw error.response?.data || error.message;
    }
};

// Signout function
export const signout = () => {
    localStorage.removeItem('auth_token');
};
