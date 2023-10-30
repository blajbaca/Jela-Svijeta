<?php
require 'config/database.php';

$database = new Database();
$db = $database->Connect();

try {
    $sql = "CREATE TABLE recipe_tags (
        recipe_id INT,
        tag_id INT,
        PRIMARY KEY (recipe_id, tag_id),
        FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id),
        FOREIGN KEY (tag_id) REFERENCES tags (tag_id)
    )";

    $db->exec($sql);

    echo "Table 'recipe_tags' created successfully.";
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}
