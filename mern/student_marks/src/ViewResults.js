import React, { useState, useEffect } from 'react';
import axios from 'axios';

function ViewResults() {
    const [results, setResults] = useState([]);

    useEffect(() => {
        axios.get('http://localhost:5000/students/results').then((res) => setResults(res.data));
    }, []);

    return (
        <div>
            <h2>Results</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Reg No</th>
                        {[...Array(4)].map((_, i) => (
                            <React.Fragment key={i}>
                                <th>Sub{i + 1} MSE</th>
                                <th>Sub{i + 1} ESE</th>
                                <th>Sub{i + 1} Total</th>
                            </React.Fragment>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {results.map((result) => (
                        <tr key={result.id}>
                            <td>{result.name}</td>
                            <td>{result.reg_no}</td>
                            {[...Array(4)].map((_, i) => (
                                <React.Fragment key={i}>
                                    <td>{result[`subject${i + 1}_mse`]}</td>
                                    <td>{result[`subject${i + 1}_ese`]}</td>
                                    <td>
                                        {(result[`subject${i + 1}_mse`] * 0.3 + result[`subject${i + 1}_ese`] * 0.7).toFixed(2)}
                                    </td>
                                </React.Fragment>
                            ))}
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default ViewResults;
