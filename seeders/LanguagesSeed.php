<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/Database.php';

$languageData = ['en_EN', 'de_DE', 'fr_FR'];

$db = new Database();
$pdo = $db->Connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tableName = 'languages';

foreach ($languageData as $language) {
    $sql = "INSERT INTO $tableName (name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $language);
    $stmt->execute();
}

echo "Language data seeding completed.";
