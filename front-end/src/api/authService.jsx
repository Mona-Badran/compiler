import api from '../services/auth';

export const signup = async (userData) => {
    try {
        const response = await api.post('http://127.0.0.1:8000/api/register', userData);
        return response.data;
    } catch (error) {
        throw error.response?.data || error.message;
    }
};

export const signin = async (credentials) => {
    try {
        const response = await api.post('http://127.0.0.1:8000/api/login', credentials);
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
        }
        return response.data;
    } catch (error) {
        throw error.response?.data || error.message;
    }
};

export const signout = () => {
    localStorage.removeItem('auth_token');
};
