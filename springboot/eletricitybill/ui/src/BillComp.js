import React, { useState } from "react";
import axios from "axios";

export default function BillComp() {
  const [bill, setBill] = useState(0);
  const [units, setUnits] = useState(0);
  
  const calculate = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.get(`http://127.0.0.1:8080/${units}`);
      setBill(res.data);
    } catch (error) {
      console.log(error);
    }
  };
  return (
    <div>
      <form onSubmit={calculate}>
        <div>
          <span>Enter units : </span>
          <input
            type="number"
            required
            onChange={(e) => setUnits(e.target.value)}
          />
        </div>
        <button type="submit">Submit</button>
      </form>
      <br />
      <br />
      <br />
      <h1>Bill amount is {bill}</h1>
    </div>
  );
}
