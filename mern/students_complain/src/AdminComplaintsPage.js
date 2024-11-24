import React, { useEffect, useState } from 'react';

const AdminComplaintsPage = () => {
    const [complaints, setComplaints] = useState([]);

    useEffect(() => {
        const fetchComplaints = async () => {
            try {
                const response = await fetch('http://localhost:5000/complaints');
                const data = await response.json();
                setComplaints(data);
            } catch (err) {
                alert('Error fetching complaints');
            }
        };
        fetchComplaints();
    }, []);

    return (
        <div>
            <h2>All Complaints</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    {complaints.map((complaint) => (
                        <tr key={complaint.id}>
                            <td>{complaint.id}</td>
                            <td>{complaint.email}</td>
                            <td>{complaint.title}</td>
                            <td>{complaint.description}</td>
                            <td>{complaint.status}</td>
                            <td>{complaint.created_at}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default AdminComplaintsPage;
