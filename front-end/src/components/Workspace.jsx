import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import { useParams } from "react-router-dom";

const WorkspaceCard = () => {
    const { id } = useParams(); 
    const [workFiles, setWorkFiles] = useState([]);

    const loadWorkspaceDetails = () => {
        axios.get(
                `http://127.0.0.1:8000/api/get_work_space/${encodeURIComponent(id)}`
            )
            .then((response) => {
                setWorkFiles(response.data.workspacefiles)
            })
            .catch((err) => {
                console.error("Error fetching workspace files");
                
            });
    }
    useEffect(() => {
        loadWorkspaceDetails();
    }, [title]);

    return(
        <div>
            <h2>Your Files</h2>
            <ul>
                {workFiles.map((files)=>(
                    <WorkspaceCard files={files} key={files.id} />
                ))}
            </ul>
        </div>
    )

    

}