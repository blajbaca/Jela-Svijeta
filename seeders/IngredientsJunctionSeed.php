<?php

require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->Connect();

$faker = Faker\Factory::create();

try {
    for ($i = 1; $i <= 50; $i++) { 
        $recipe_id = $faker->numberBetween(1, 50); 
        $ingredient_id = $faker->numberBetween(1, 50); 

        $stmt = $db->prepare("INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES (?,?)"); 
        $stmt->execute([$recipe_id,$ingredient_id]);
    }

    echo "Data seeding for 'recipe_ingredients' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
