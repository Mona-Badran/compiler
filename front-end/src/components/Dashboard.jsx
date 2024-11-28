import axios from "axios";
import React, {useEffect, useState} from "react";
import { useNavigate } from "react-router-dom";
import "./Dashboard.css";
import DashboardCard from "../sub-components/DashboardCard.jsx"

const Dashboard = () => {
  const [yourWorkspaces, setYourWorkspaces] = useState([]);
  const [collWorkspaces, setCollWorkspaces] = useState([]);

  const loadYourWS = () => {
    axios.post("http://127.0.0.1:8000/api/get_your_ws",{},{
      headers:{
        Authorization: `Bearer ${localStorage.getItem("token")}`

      }
    }).then((response)=>{
      setYourWorkspaces(response.data.workspaces);
      //console.log(response.data.workspaces)
    }).catch((error)=>{
      console.log("error")
    })
  }
  useEffect(()=>{
    loadYourWS()
  },[])

  const loadCollWS = () => {
    axios.post("http://127.0.0.1:8000/api/get_coll_ws",{},{
      headers:{
        Authorization: `Bearer ${localStorage.getItem("token")}`

      }
    }).then((response)=>{
      setCollWorkspaces(response.data.workspaces);
      //console.log(response.data.workspaces)
    }).catch((error)=>{
      console.log("error")
    })
  }
  useEffect(()=>{
    loadCollWS()
  },[])

  return (
    <div className="landing-page">
        <h1>Dashboard</h1>
        <div className="workspace-section">
            <div className="owned-ws">
                <h3>Your Workspaces</h3>
                <ul>
                    {yourWorkspaces.map((workspace) => (
                        <DashboardCard dash={workspace} key={workspace.id} />
                    ))}
                </ul>
            </div>
            <div className="collab-ws">
                <h3>Collaborated Workspaces</h3>
                <ul>
                    {collWorkspaces.map((workspace) => (
                        <DashboardCard dash={workspace} key={workspace.id} />
                    ))}
                </ul>
            </div>
        </div>
    </div>
);
}

export default Dashboard