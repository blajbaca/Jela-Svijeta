<?php 

require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->Connect();

try {
    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('en_US');
        $titleEn = $faker->realText(10); 
        $slug = $faker->slug;

        $stmt = $db->prepare("INSERT INTO ingredients (titleEn, slug) VALUES (?,?)");
        $stmt->execute([$titleEn, $slug]);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('de_DE');
        $titleDe = $faker->realText(10); 
        $slug = $faker->slug;

        $stmt = $db->prepare("INSERT INTO ingredients (titleDe, slug) VALUES (?,?)");
        $stmt->execute([$titleDe, $slug]);
    }

    for ($i = 1; $i <= 20; $i++) {
        $faker = Faker\Factory::create('fr_FR');
        $titleFr = $faker->realText(10); 
        $slug = $faker->slug;

        $stmt = $db->prepare("INSERT INTO ingredients (titleFr, slug) VALUES (?,?)");
        $stmt->execute([$titleFr, $slug]);
    }

    echo "Data seeding completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
