import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import WorkspaceCard from "../sub-components/WorkspaceCard";
import "./Workspace.css"; 
import { useNavigate } from "react-router-dom";

const Workspace = () => {
    const { id } = useParams(); 
    const [workFiles, setWorkFiles] = useState([]);
    const navigate = useNavigate();

    const loadWorkspaceDetails = () => {
        axios
            .post(`http://127.0.0.1:8000/api/get_work_space/${encodeURIComponent(id)}`,{},{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            })
            .then((response) => {
                setWorkFiles(response.data.workspacefiles);
                //console.log(response.data.workspacefiles)
            })
            .catch((err) => {
                console.error("Error fetching workspace files", err);
            });
    };

    useEffect(() => {
        loadWorkspaceDetails();
    }, [id]);
    //console.log()
    return (
        <div className="workspace-container">
            <div className="workspace-files">
                <h2>Workspace Files</h2>
                <ul>
                    {workFiles.map((file) => (
                        // <li key={file.id}>{file.name}</li>
                        <WorkspaceCard files={file} key={file.id} />
                    
                    ))}
                </ul>
                <button onClick={() => navigate(`/add-collaborators/${id}`)}>
                    Add Collaborators
                </button>
            </div>
            <div className="workspace-compiler">
                <div className="placeholder">
                    <p>Select a file to view its content</p>
                </div>
            </div>
        </div>
    );
};

export default Workspace;
