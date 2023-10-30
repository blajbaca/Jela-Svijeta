<?php
require 'config/database.php';

$database = new Database();
$db = $database->Connect();

try {
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        $db->exec("DROP TABLE $table");
        echo "Dropped table: $table" . PHP_EOL;
    }

    echo "All tables dropped successfully." . PHP_EOL;
} catch (PDOException $e) {
    die("Table dropping failed: " . $e->getMessage());
}
