import React from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const WorkspaceCard = ({files}) => {
    const navigate = useNavigate();
    const {id , name} = files;

    return(
        <div>
            <h4 onClick={()=>{
                navigate(`/file/${id}`);       
            }}>{name}</h4>

        </div>
    );
}
export default WorkspaceCard;