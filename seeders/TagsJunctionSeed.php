<?php
require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create();
$database = new Database();
$db = $database->Connect();
$uniquePairs=[];

try {
    for ($i = 1; $i <= 20; $i++) {
        $recipe_id = $faker->numberBetween(1, 20);
        $tag_id = $faker->numberBetween(1, 20);
        $pair = $recipe_id . '-' . $tag_id; 
        
        if (!in_array($pair, $uniquePairs)) {
            $stmt = $db->prepare("INSERT INTO recipe_tags (recipe_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$recipe_id, $tag_id]);
            $uniquePairs[] = $pair;
        }
    }

    echo "Data seeding for 'recipe_tags' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
