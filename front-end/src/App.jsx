import React from "react";
import { BrowserRouter as Router, Routes, Route, Navigate } from "react-router-dom";
import Signup from "./components/Signup";
import Signin from "./components/Signin";
import Dashboard from "./components/Dashboard";
import ProtectedRoute from "./components/ProtectedRoute";
import Workspace from "./components/Workspace";
import WorkspaceFileCard from "./sub-components/WorkspaceFileCard";
import AddCollaborators from "./components/AddCollaborators";

const App = () => {
    return (
        <Router>
            <Routes>
                {/* Authentication Routes */}
                <Route path="/" element={<Navigate to="/login" replace />} />
                <Route path="/register" element={<Signup />} />
                <Route path="/login" element={<Signin />} />

                {/* Dashboard */}
                <Route
                    path="/dashboard"
                    element={
                        <ProtectedRoute>
                            <Dashboard />
                        </ProtectedRoute>
                    }
                />

                {/* Workspace */}
                <Route
                    path="/dashboard/:id"
                    element={
                        <ProtectedRoute>
                            <Workspace />
                        </ProtectedRoute>
                    }
                />

                {/* Compiler with File Content */}
                <Route
                    path="/file/:id"
                    element={
                        <ProtectedRoute>
                            <WorkspaceFileCard />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="/add-collaborators/:id"
                    element={
                        <ProtectedRoute>
                            <AddCollaborators />
                        </ProtectedRoute>
                    }
                />
            </Routes>
        </Router>
    );
};

export default App;
