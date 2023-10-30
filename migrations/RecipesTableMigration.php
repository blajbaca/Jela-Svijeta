<?php
require __DIR__ . '/../config/Database.php';

$database = new Database();
$db = $database->Connect();

try {
    $sql = "CREATE TABLE recipes (
        recipe_id INT AUTO_INCREMENT PRIMARY KEY,
        titleEn VARCHAR(255) NOT NULL,
        titleDe VARCHAR(255) NOT NULL,
        titleFr VARCHAR(255) NOT NULL,
        descriptionEn TEXT,
        descriptionDe TEXT,
        descriptionFr TEXT,
        status VARCHAR(50) NOT NULL,
        category_id INT,
        language_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        FOREIGN KEY (category_id) REFERENCES categories (category_id),
        FOREIGN KEY (language_id) REFERENCES languages (language_id)
    )";

    $db->exec($sql);

    echo "Table 'recipes' created successfully.";
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}
