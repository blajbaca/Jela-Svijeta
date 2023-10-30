<?php 
require 'config/database.php';
require 'vendor/autoload.php';

try {
    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('en_US');
        $titleEn = $faker->realText(1); 
        $slug = $faker->slug;

        $sql = "INSERT INTO ingredients (titleEn, slug) 
                VALUES ('$titleEn', '$slug')";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('de_DE');
        $titleDe = $faker->realText(1); 
        $slug = $faker->slug;

        $sql = "INSERT INTO ingredients (titleDe, slug) 
                VALUES ('$titleDe', '$slug')";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('fr_FR');
        $titleFr = $faker->realText(1); 
        $slug = $faker->slug;

        $sql = "INSERT INTO ingredients (titleFr, slug) 
                VALUES ('$titleFr', '$slug')";
        $db->exec($sql);
    }

    echo "Data seeding completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
