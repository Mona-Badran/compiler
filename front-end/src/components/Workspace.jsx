import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";

const Workspace = () => {
    const { id } = useParams(); // Get workspace ID from URL
    const [workFiles, setWorkFiles] = useState([]);

    const loadWorkspaceDetails = () => {
        axios
            .post(`http://127.0.0.1:8000/api/get_work_space/${encodeURIComponent(id)}`,{},{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            })
            .then((response) => {
                setWorkFiles(response.data.workspacefiles);
                console.log(response.data.workspacefiles)
            })
            .catch((err) => {
                console.error("Error fetching workspace files", err);
            });
    };

    useEffect(() => {
        loadWorkspaceDetails();
    }, [id]);
    console.log()
    return (
        <div>
            <h2>Workspace Files</h2>
            <ul>
                {workFiles.map((file) => (
                    <li key={file.id}>{file.name}</li>
                ))}
            </ul>
        </div>
    );
};

export default Workspace;
