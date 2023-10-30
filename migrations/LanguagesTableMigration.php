<?php
require 'config/database.php';

try {
    $sql = "CREATE TABLE languages (
        language_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";

    $db->exec($sql);

    echo "Table 'languages' created successfully.";
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}
