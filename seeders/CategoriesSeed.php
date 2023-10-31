<?php
ini_set('memory_limit', '256M');


require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../vendor/autoload.php';

$database = new Database();
$db = $database->Connect();

$fakerEn = Faker\Factory::create('en_US');
$fakerDe = Faker\Factory::create('de_DE');
$fakerFr = Faker\Factory::create('fr_FR');

try {
    for ($i = 1; $i <= 10; $i++) {
        $titleEn = $fakerEn->realText(10);
        $titleDe = $fakerDe->realText(10);
        $titleFr = $fakerFr->realText(10);
        $slug = $fakerEn->slug;
        $stmt = $db->prepare("INSERT INTO categories (titleEn, titleDe, titleFr, slug) VALUES (?,?,?,?)");
        $stmt->execute([$titleEn,$titleDe,$titleFr, $slug]);
    }

    echo "Data seeding completed.";
} catch (PDOException $e) {
    die("Data seeding failed: " . $e->getMessage());
}
