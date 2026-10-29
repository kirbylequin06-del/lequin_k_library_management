Library Management System
SIMPLE PHP PDO OOP VERSION

FILES:
- index.php
- connection.php
- handler.php
- style.css
- Book.php
- database/lequin_k_library_management.sql

HOW TO RUN:
1. Put this project folder inside C:\xampp\htdocs\
2. Start Apache and MySQL.
3. Open http://localhost/phpmyadmin
4. Import database/lequin_k_library_management.sql
5. Open http://localhost/lequin_k_library_management/lequin_k_library_management/

DATABASE CONNECTION:
- Database: lequin_k_library_management
- Server: 127.0.0.1, port 3307 (this XAMPP installation)
- User: root
- Password: empty
- Connection settings are in connection.php.

FLOW:
Form -> handler.php -> Book object -> PDO query -> MySQL -> index.php

NOTE:
The Prelim defines CRUD Book Records and book search, but its ERD section is blank. These are minimal inferred book fields.
