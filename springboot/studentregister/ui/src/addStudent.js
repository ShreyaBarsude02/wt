import axios from "axios";
import React, { useState } from "react";

export default function AddStudent() {
  const [name, setName] = useState("");
  const [roll, setRoll] = useState(0);
  const add = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post("http://127.0.0.1:8080/", {
        name,
        roll,
      });
      console.log(res.data);
      window.location.reload();
    } catch (error) {
      console.log(error);
    }
  };
  return (
    <div>
      <form onSubmit={add}>
        <div>
          <span>Name : </span>
          <input
            type="text"
            required
            onChange={(e) => setName(e.target.value)}
          />
        </div>
        <div>
          <span>Roll No. : </span>
          <input
            type="number"
            required
            onChange={(e) => setRoll(e.target.value)}
          />
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  );
}
