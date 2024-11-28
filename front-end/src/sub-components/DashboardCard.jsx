import React from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import "../components/Dashboard.css";

const DashboardCard = ({dash}) => {
    const navigate = useNavigate();
    const {id , name} = dash;

    return(
        <div className="dashboard-card">
            <h5 onClick={()=>{
                navigate(`/dashboard/${id}`);       
            }}>{name}</h5>

        </div>
    );
}
export default DashboardCard;