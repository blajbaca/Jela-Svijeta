<?php
require 'config/database.php';

$database = new Database();
$db = $database->Connect();

try {
    $sql = "CREATE TABLE categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        titleEn VARCHAR(255) NOT NULL,
        titleDe VARCHAR(255) NOT NULL,
        titleFr VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL
    )";

    $db->exec($sql);

    echo "Table 'categories' created successfully.";
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}
