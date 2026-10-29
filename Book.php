<?php
class Book {
 private $conn;
 public function __construct($conn) { $this->conn = $conn; }
 public function getAll() { return $this->conn->query('SELECT * FROM books ORDER BY book_id DESC')->fetchAll(PDO::FETCH_ASSOC); }
 public function add($title,$author,$category,$isbn,$quantity,$status) { return $this->conn->prepare('INSERT INTO books (title,author,category,isbn,quantity,status) VALUES (?,?,?,?,?,?)')->execute([$title,$author,$category,$isbn,$quantity,$status]); }
 public function update($book_id,$title,$author,$category,$isbn,$quantity,$status) { return $this->conn->prepare('UPDATE books SET title=?,author=?,category=?,isbn=?,quantity=?,status=? WHERE book_id=?')->execute([$title,$author,$category,$isbn,$quantity,$status,$book_id]); }
 public function delete($book_id) { return $this->conn->prepare('DELETE FROM books WHERE book_id=?')->execute([$book_id]); }
 public function search($keyword) { $stmt=$this->conn->prepare('SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR category LIKE ? OR isbn LIKE ? OR quantity LIKE ? OR status LIKE ? ORDER BY book_id DESC'); $stmt->execute(array_fill(0,6,'%'.$keyword.'%')); return $stmt->fetchAll(PDO::FETCH_ASSOC); }
}
