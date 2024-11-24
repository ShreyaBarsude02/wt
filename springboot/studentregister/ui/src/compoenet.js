import React, { useEffect, useState } from "react";
import axios from "axios";

export default function Compoenet() {
  const [data, setData] = useState([]);

  useEffect(() => {
    const getData = async () => {
      try {
        const res = await axios.get("http://127.0.0.1:8080/");
        setData(res.data);
      } catch (error) {
        console.log(error);
      }
    };
    getData();
  }, []);
  const del = async (e) => {
    const id = e.currentTarget.getAttribute("data-id");
    try {
      await axios.delete(`http://127.0.0.1:8080/${id}`);
      console.log("Done delete");
      window.location.reload();
    } catch (error) {
      console.log(error);
    }
  };
  return (
    <div>
      <table style={{ border: "1px solid black" }}>
        <tr>
          <th style={{ border: "1px solid black" }}>Roll No.</th>
          <th style={{ border: "1px solid black" }}>Student name</th>
          <th style={{ border: "1px solid black" }}>Delete student</th>
        </tr>
        {data.map((item, ind) => (
          <tr>
            <td style={{ border: "1px solid black" }}>{item.roll}</td>
            <td style={{ border: "1px solid black" }}>{item.name}</td>
            <td style={{ border: "1px solid black" }}>
              <button data-id={item.roll} onClick={del}>
                Delete
              </button>
            </td>
          </tr>
        ))}
      </table>
    </div>
  );
}
