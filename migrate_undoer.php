<?php
require __DIR__ . '/config/Database.php';


$database = new Database();
$db = $database->Connect();

try {
    $db->exec("SET FOREIGN_KEY_CHECKS=0");
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        $db->exec("DROP TABLE $table");
        echo "Dropped table: $table" . PHP_EOL;
    }
    $db->exec("SET FOREIGN_KEY_CHECKS=1");

    echo "All tables dropped successfully." . PHP_EOL;
} catch (PDOException $e) {
    die("Table dropping failed: " . $e->getMessage());
}
