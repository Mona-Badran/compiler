import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";

const WorkspaceFileCard = () => {
    const { id } = useParams(); // Get workspace ID from URL
    const [workFiles, setWorkFiles] = useState([]);

    const loadWorkspaceDetails = () => {
        axios
            .post(`http://127.0.0.1:8000/api/get_file/${encodeURIComponent(id)}`,{},{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            })
            .then((response) => {
                setWorkFiles(response.data.content);
                console.log(response.data.content)
            })
            .catch((err) => {
                console.error("Error fetching workspace files", err);
            });
    };

    useEffect(() => {
        loadWorkspaceDetails();
    }, [id]);
    
    return(
        <div></div>
    );


}
export default WorkspaceFileCard;