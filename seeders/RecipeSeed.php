<?php

require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->Connect();

try {
    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('en_US');
        $titleEn = $faker->realText(50); 
        $descriptionEn = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $stmt = $db->prepare("INSERT INTO recipes (titleEn, descriptionEn, status, category_id, language_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$titleEn,$descriptionEn,$status,$category_id,$language_id]);
    }

    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('de_DE');
        $titleDe = $faker->realText(50); 
        $descriptionDe = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $stmt = $db->prepare("INSERT INTO recipes (titleDe, descriptionDe, status, category_id, language_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$titleDe,$descriptionDe,$status,$category_id,$language_id]);
    }

    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('fr_FR');
        $titleFr = $faker->realText(50); 
        $descriptionFr = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $stmt = $db->prepare("INSERT INTO recipes (titleFr, descriptionFr, status, category_id, language_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$titleFr,$descriptionFr,$status,$category_id,$language_id]);
    }

    echo "Data seeding for 'recipes' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
