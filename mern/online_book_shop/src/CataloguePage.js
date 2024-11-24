import React, { useEffect, useState } from 'react';

const CataloguePage = () => {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        const fetchBooks = async () => {
            try {
                const response = await fetch('http://localhost:5000/catalogue');
                const data = await response.json();
                setBooks(data);
            } catch (err) {
                console.error(err);
                alert('Error fetching books');
            }
        };
        fetchBooks();
    }, []);

    return (
        <div>
            <h2>Book Catalogue</h2>
            <ul>
                {books.map((book) => (
                    <li key={book.id}>
                        <h3>{book.title}</h3>
                        <p>Author: {book.author}</p>
                        <p>Price: ${book.price}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default CataloguePage;
