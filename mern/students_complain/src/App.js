import React, { useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import LoginPage from './LoginPage';
import ComplaintPage from './ComplaintPage';
import AdminComplaintsPage from './AdminComplaintsPage';

const App = () => {
    const [user, setUser] = useState(null);

    return (
        <Router>
            <Routes>
                <Route path="/" element={<LoginPage setUser={setUser} />} />
                <Route
                    path="/complaints"
                    element={user?.role === 'student' ? <ComplaintPage user={user} /> : <div>Unauthorized</div>}
                />
                <Route
                    path="/admin"
                    element={user?.role === 'admin' ? <AdminComplaintsPage /> : <div>Unauthorized</div>}
                />
            </Routes>
        </Router>
    );
};

export default App;
