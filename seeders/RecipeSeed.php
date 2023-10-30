<?php

require 'config/database.php';
require 'vendor/autoload.php';



try {
    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('en_US');
        $titleEn = $faker->realText(50); 
        $descriptionEn = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $sql = "INSERT INTO recipes (titleEn, descriptionEn, status, category_id, language_id)
                VALUES ('$titleEn', '$descriptionEn', '$status', $category_id, $language_id)";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('de_DE');
        $titleDe = $faker->realText(50); 
        $descriptionDe = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $sql = "INSERT INTO recipes (titleDe, descriptionDe, status, category_id, language_id)
                VALUES ('$titleDe', '$descriptionDe', '$status', $category_id, $language_id)";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 50; $i++) { 
        $faker = Faker\Factory::create('fr_FR');
        $titleFr = $faker->realText(50); 
        $descriptionFr = $faker->realText(200); +
        $status = $faker->randomElement(['created', 'deleted']);
        $category_id = $faker->numberBetween(1, 5);
        $language_id = $faker->numberBetween(1, 3);

        $sql = "INSERT INTO recipes (titleFr, descriptionFr, status, category_id, language_id)
                VALUES ('$titleFr', '$descriptionFr', '$status', $category_id, $language_id)";
        $db->exec($sql);
    }

    echo "Data seeding for 'recipes' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
