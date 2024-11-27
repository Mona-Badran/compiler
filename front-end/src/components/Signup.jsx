import axios from "axios";
import React, {useEffect, useState} from "react";
import { useNavigate } from "react-router-dom";
import './Auth.css';

const Signup=() => {
    const Navigate = useNavigate();
    const [error, setError] = useState("")
    const [SignupForm, setSignupForm] = useState({
        username: "",
        email: "",
        password: "",
        confirmPassword: "",
    });
    useEffect(()=>{
        // console.log(SignupForm)
    },[SignupForm])


    return(
        <div className="auth-container">
            <form className="auth-form">
                <h1>Signup</h1>
                <input type="text" placeholder="Username" onChange={(e)=>{
                    setSignupForm({
                        ...SignupForm,
                        username: e.target.value,
                    });
                }}/>
                <input type="email" placeholder="Email" onChange={(e)=>{
                    setSignupForm({
                        ...SignupForm,
                        email:e.target.value,
                    });
                }}/>
                <input type="password" placeholder="Password" onChange={(e)=>{
                    setSignupForm({
                        ...SignupForm,
                        password:e.target.value,
                    });
                }}/>
                <input type="confirmPassword" placeholder="Confirm Password" onChange={(e)=>{
                    setSignupForm({
                        ...SignupForm,
                        confirmPassword:e.target.value,
                    });
                }}/>
                <button type="button" onClick={()=>{
                    if (SignupForm.password !== SignupForm.confirmPassword) {
                        setError("Passwords do not match!");
                        return;
                    }
                    
                    setError("");
                    const data = new FormData();
                    data.append("username", SignupForm.username)
                    data.append("email", SignupForm.email)
                    data.append("password", SignupForm.password)

                    axios("http://127.0.0.1:8000/api/register",{
                        method:"POST",
                        data:data
                    }).then((response)=>{
                        console.log(response.data.user)
                        localStorage.setItem("token", response.data.token)
                        setSignupForm({
                            username: "",
                            email: "",
                            password: "",
                            confirmPassword: "",
                        });
                        Navigate("/login")
                    }).catch((error)=>{
                        setError(error.response.data.status)
                    });
                }}>Signup</button>
                {error && <p>{error}</p>}
            </form>
        </div>
    )
};
export default Signup;