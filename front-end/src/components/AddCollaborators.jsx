import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
//import "./AddCollaborators.css";
import { useParams } from "react-router-dom";
import axios from "axios";

const AddCollaborators = () => {
    const navigate = useNavigate();
    const { id } = useParams(); 
    const [email, setEmail] = useState("");

    const handleInvite = () => {
        if (!email) {
            alert("Please enter an email.");
            return;
        }
        const data = new FormData();
        data.append("workspaces_id", id);
        data.append("recipient_email", email);
        axios("http://127.0.0.1:8000/api/send_email",{
            method:"POST",
            data:data,
        },{
            headers:{
                Authorization: `Bearer ${localStorage.getItem("token")}`,
                
            },
        }).then((response)=>{
            console.log("email sent")
        }).catch((error)=>{
            console.log("error")
        })
    };




    return (
        <div className="add-collaborators-container">
            <h2>Add Collaborators</h2>
            <div className="collaborator-input">
                <input
                    type="email"
                    placeholder="Enter collaborator's email"
                    value={email}
                    onChange={(e)=>{
                        setEmail(e.target.value);
                    }}
                />
                <button onClick={handleInvite}>Invite</button>
            </div>
        </div>
    );
};

export default AddCollaborators;
