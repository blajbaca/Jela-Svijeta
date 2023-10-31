<?php

require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->Connect();

try {
    $fakerEn = Faker\Factory::create('en_US');
    $fakerDe = Faker\Factory::create('de_DE');
    $fakerFr = Faker\Factory::create('fr_FR');

    for ($i = 1; $i <= 50; $i++) {

        $titleEn = $fakerEn->realText(50);
        $descriptionEn = $fakerEn->realText(200);
        $titleDe = $fakerDe->realText(50);
        $descriptionDe = $fakerDe->realText(200);
        $titleFr = $fakerFr->realText(50);
        $descriptionFr = $fakerFr->realText(200);

        $status = $fakerEn->randomElement(['created', 'deleted']);
        $category_id = $fakerEn->numberBetween(1, 5);
        $language_id = $fakerEn->numberBetween(1, 3);

        $stmt = $db->prepare("INSERT INTO recipes (titleEn, descriptionEn, titleDe, descriptionDe, titleFr, descriptionFr, status, category_id, language_id) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$titleEn, $descriptionEn, $titleDe, $descriptionDe, $titleFr, $descriptionFr, $status, $category_id, $language_id]);
    }

    echo "Data seeding for 'recipes' completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
