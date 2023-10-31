<?php


$database = new Database();
$db = $database->Connect();

try {
    $sql = "CREATE TABLE recipe_ingredients (
        recipe_id INT,
        ingredient_id INT,
        PRIMARY KEY (recipe_id, ingredient_id),
        FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id),
        FOREIGN KEY (ingredient_id) REFERENCES ingredients (ingredient_id)
    )";

    $db->exec($sql);

    echo "Table 'recipe_ingredients' created successfully.";
} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}
