<?php

require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/Book.php";

$record = new Book($conn);

if (isset($_POST["add_record"])) {

    $title = trim($_POST["title"] ?? "");
    $author = trim($_POST["author"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $isbn = trim($_POST["isbn"] ?? "");
    $quantity = $_POST["quantity"] ?? "";
    $status = trim($_POST["status"] ?? "");

    $record->add(
        $title,
        $author,
        $category,
        $isbn,
        $quantity,
        $status
    );

    header("Location: index.php?message=added");
    exit();
}

if (isset($_POST["update_record"])) {

    $book_id = $_POST["book_id"];

    $title = trim($_POST["title"] ?? "");
    $author = trim($_POST["author"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $isbn = trim($_POST["isbn"] ?? "");
    $quantity = $_POST["quantity"] ?? "";
    $status = trim($_POST["status"] ?? "");

    $record->update(
        $book_id,
        $title,
        $author,
        $category,
        $isbn,
        $quantity,
        $status
    );

    header("Location: index.php?message=updated");
    exit();
}

if (isset($_POST["delete_record"])) {

    $book_id = $_POST["book_id"];

    $record->delete($book_id);

    header("Location: index.php?message=deleted");
    exit();
}

?>
