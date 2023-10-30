<?php 
require 'config/database.php';
require 'vendor/autoload.php';

try {
    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('en_US');
        $titleEn = $faker->realText(5); 
        $slug = $faker->slug;

        $sql = "INSERT INTO categories (titleEn, slug) 
                VALUES ('$titleEn', '$slug')";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('de_DE');
        $titleDe = $faker->realText(5); 
        $slug = $faker->slug;

        $sql = "INSERT INTO categories (titleDe, slug) 
                VALUES ('$titleDe', '$slug')";
        $db->exec($sql);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('fr_FR');
        $titleFr = $faker->realText(5); 
        $slug = $faker->slug;

        $sql = "INSERT INTO categories (titleFr, slug) 
                VALUES ('$titleFr', '$slug')";
        $db->exec($sql);
    }

    echo "Data seeding completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
