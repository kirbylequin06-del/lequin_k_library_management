CREATE DATABASE IF NOT EXISTS lequin_k_library_management;

USE lequin_k_library_management;

CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100),
    category VARCHAR(60),
    isbn VARCHAR(30),
    quantity INT,
    status VARCHAR(30)
);

INSERT INTO books
(title, author, category, isbn, quantity, status)
VALUES
('Introduction to Programming', 'Sample Author', 'Computer', '9780000000000', 5, 'Available');
