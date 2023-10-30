<?php
require 'config/database.php';
require 'vendor/autoload.php';
$faker = Faker\Factory::create();

$database = new Database();
$db = $database->Connect();

try {
    for ($i = 1; $i <= 50; $i++) {
        $recipe_id = $faker->numberBetween(1, 50);
        $tag_id = $faker->numberBetween(1, 50);

        $sql = "INSERT INTO recipe_tags (recipe_id, tag_id)
                VALUES ($recipe_id, $tag_id)";
        $db->exec($sql);
    }

    echo "Data seeding for 'recipe_tags' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
