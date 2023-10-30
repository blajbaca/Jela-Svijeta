<?php
require 'config/database.php';
require 'vendor/autoload.php'; 

$database = new Database();
$db = $database->Connect();

$faker = Faker\Factory::create();

try {
    for ($i = 1; $i <= 50; $i++) { 
        $recipe_id = $faker->numberBetween(1, 50); 
        $ingredient_id = $faker->numberBetween(1, 50); 

        $sql = "INSERT INTO recipe_ingredients (recipe_id, ingredient_id)
                VALUES ($recipe_id, $ingredient_id)";
        $db->exec($sql);
    }

    echo "Data seeding for 'recipe_ingredients' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
