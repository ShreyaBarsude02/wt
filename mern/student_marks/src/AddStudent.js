import React, { useState } from 'react';

function AddStudent() {
    const [formData, setFormData] = useState({
        name: '',
        reg_no: '',
        subject1_mse: '',
        subject1_ese: '',
        subject2_mse: '',
        subject2_ese: '',
        subject3_mse: '',
        subject3_ese: '',
        subject4_mse: '',
        subject4_ese: '',
    });

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            // Use fetch instead of axios
            const response = await fetch('http://localhost:5000/students/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            });

            if (!response.ok) {
                // If the response is not ok, throw an error
                throw new Error(`Request failed with status ${response.status}`);
            }

            const result = await response.json();
            alert('Student added successfully');
        } catch (err) {
            console.error('Error occurred:', err);
            alert('Error: ' + err.message || 'Something went wrong');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <h2>Add Student</h2>
            <input name="name" placeholder="Name" onChange={handleChange} required />
            <input name="reg_no" placeholder="Reg No" onChange={handleChange} required />
            {[...Array(4)].map((_, i) => (
                <div key={i}>
                    <input
                        name={`subject${i + 1}_mse`}
                        placeholder={`Subject ${i + 1} MSE`}
                        onChange={handleChange}
                        required
                    />
                    <input
                        name={`subject${i + 1}_ese`}
                        placeholder={`Subject ${i + 1} ESE`}
                        onChange={handleChange}
                        required
                    />
                </div>
            ))}
            <button type="submit">Add</button>
        </form>
    );
}

export default AddStudent;
