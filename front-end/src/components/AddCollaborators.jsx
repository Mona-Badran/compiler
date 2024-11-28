import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import "./AddCollaborators.css";
import { useParams } from "react-router-dom";
import axios from "axios";
import { useEffect } from "react";

const AddCollaborators = () => {
    const navigate = useNavigate();
    const { id } = useParams(); 
    const [email, setEmail] = useState("");
    const [collaborators, setCollaborators] = useState([]);

    const fetchCollaborators = () => {
        const data = new FormData();
        data.append("workspaces_id", id);

        axios.post("http://127.0.0.1:8000/api/display_collabs", {data:data}, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                setCollaborators(response.data.collaborators); 
            })
            .catch((error) => 
                console.error("Error fetching"))
    };


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


    const toggleMode = (index) => {
        const collaborator = collaborators[index];
        const newMode = collaborator.mode === "View" ? "Edit" : "View";

        const data = new FormData();
        data.append("workspaces_id", id);
        data.append("email", collaborator.email);
        data.append("role", newMode);

        axios.post("http://127.0.0.1:8000/api/change_role", {data:data}, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then(() => {
                setCollaborators((prev) =>
                    prev.map((item, i) =>
                        i === index ? { ...item, mode: newMode } : item
                    )
                );
                console.log(`Role updated`);
            })
            .catch((error) => {
                console.error("Error updating");
            });
    };
    useEffect(() => {
        fetchCollaborators();
    }, [id]);

    return (
        <div className="add-collaborators-container">
            <h2>Add Collaborators</h2>
            <div className="collaborator-input">
                <input
                    type="email"
                    placeholder="Enter collaborator's email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <button onClick={handleInvite}>Invite</button>
            </div>
            <ul className="collaborators-list">
                {collaborators.map((collaborator, index) => (
                    <li key={index} className="collaborator-item">
                        <span>{collaborator.email}</span>
                        <button onClick={() => toggleMode(index)}>{collaborator.mode}</button>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default AddCollaborators;
