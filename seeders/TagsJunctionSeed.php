<?php
require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();

$database = new Database();
$db = $database->Connect();

try {
    for ($i = 1; $i <= 50; $i++) {
        $recipe_id = $faker->numberBetween(1, 50);
        $tag_id = $faker->numberBetween(1, 50);

        $stmt = $db->prepare("INSERT INTO recipe_tags (recipe_id, tag_id) VALUES (?,?)");
        $stmt->execute([$recipe_id,$tag_id]);
    }

    echo "Data seeding for 'recipe_tags' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
