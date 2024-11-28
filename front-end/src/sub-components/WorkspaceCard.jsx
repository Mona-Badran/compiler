import React from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import "../components/Workspace.css"

const WorkspaceCard = ({files}) => {
    const navigate = useNavigate();
    const {id , name} = files;

    return (
        <div className="workspace-file-card" onClick={()=>{
            navigate(`/file/${id}`);       
        }}>
            <h4>{name}</h4>
        </div>
    );
}
export default WorkspaceCard;