<?php

require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/Book.php";

$record = new Book($conn);

$edit_data = null;

if (isset($_GET["search"])) {

    $keyword = trim($_GET["keyword"] ?? "");

    $records = $record->search($keyword);

} else {

    $records = $record->getAll();

}

if (isset($_GET["edit"])) {

    $edit_id = $_GET["edit"];

    foreach ($records as $row) {

        if ($row["book_id"] == $edit_id) {

            $edit_data = $row;

            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Library Management System</h1>
    <p class="subtitle">Simple PHP PDO OOP CRUD System</p>

    <div class="note">The Prelim defines CRUD Book Records and book search, but its ERD section is blank. These are minimal inferred book fields.</div>

    <?php if (isset($_GET["message"])): ?>
        <div class="message">
            <?php
            if ($_GET["message"] == "added") echo "Record added successfully.";
            if ($_GET["message"] == "updated") echo "Record updated successfully.";
            if ($_GET["message"] == "deleted") echo "Record deleted successfully.";
            ?>
        </div>
    <?php endif; ?>

    <div class="box">

        <h2><?= $edit_data ? "Update Record" : "Add Record"; ?></h2>

        <form action="handler.php" method="POST">

            <?php if ($edit_data): ?>
                <input type="hidden" name="book_id" value="<?= $edit_data["book_id"]; ?>">
            <?php endif; ?>

            <div class="form-grid">

                <div>
                    <label>Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($edit_data["title"] ?? ""); ?>">
                </div>

                <div>
                    <label>Author</label>
                    <input type="text" name="author" value="<?= htmlspecialchars($edit_data["author"] ?? ""); ?>">
                </div>

                <div>
                    <label>Category</label>
                    <input type="text" name="category" value="<?= htmlspecialchars($edit_data["category"] ?? ""); ?>">
                </div>

                <div>
                    <label>ISBN</label>
                    <input type="text" name="isbn" value="<?= htmlspecialchars($edit_data["isbn"] ?? ""); ?>">
                </div>

                <div>
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="<?= htmlspecialchars($edit_data["quantity"] ?? ""); ?>">
                </div>

                <div>
                    <label>Status</label>
                    <select name="status"><option value="">Select</option><option value="Available" <?= ($edit_data["status"] ?? "") == "Available" ? "selected" : ""; ?>>Available</option><option value="Borrowed" <?= ($edit_data["status"] ?? "") == "Borrowed" ? "selected" : ""; ?>>Borrowed</option><option value="Unavailable" <?= ($edit_data["status"] ?? "") == "Unavailable" ? "selected" : ""; ?>>Unavailable</option></select>
                </div>

            </div>

            <?php if ($edit_data): ?>
                <button type="submit" name="update_record" class="btn">Update</button>
                <a href="index.php" class="cancel">Cancel</a>
            <?php else: ?>
                <button type="submit" name="add_record" class="btn">Add</button>
            <?php endif; ?>

        </form>

    </div>

    <div class="box">

        <div class="table-header">

            <h2>Records</h2>

            <form method="GET" class="search">

                <input type="text" name="keyword"
                       value="<?= htmlspecialchars($_GET["keyword"] ?? ""); ?>"
                       placeholder="Search">

                <button type="submit" name="search" class="btn">Search</button>

                <a href="index.php" class="cancel">Clear</a>

            </form>

        </div>

        <div class="table-container">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($records as $row): ?>

                        <tr>
                            <td><?= $row["book_id"]; ?></td>
                            <td><?= htmlspecialchars($row["title"]); ?></td>
                            <td><?= htmlspecialchars($row["author"]); ?></td>
                            <td><?= htmlspecialchars($row["category"]); ?></td>
                            <td><?= htmlspecialchars($row["isbn"]); ?></td>
                            <td><?= htmlspecialchars($row["quantity"]); ?></td>
                            <td><?= htmlspecialchars($row["status"]); ?></td>
                            <td class="actions">

                                <a href="index.php?edit=<?= $row["book_id"]; ?>" class="edit">Edit</a>

                                <form action="handler.php" method="POST"
                                      onsubmit="return confirm('Delete this record?');">

                                    <input type="hidden" name="book_id" value="<?= $row["book_id"]; ?>">

                                    <button type="submit" name="delete_record" class="delete">Delete</button>

                                </form>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                    <?php if (count($records) == 0): ?>
                        <tr>
                            <td colspan="8">No record found.</td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
