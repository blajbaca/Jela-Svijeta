<?php
require __DIR__ . '/config/Database.php';

$nonJunctionMigrationFiles = [
    'migrations\CategoriesTableMigration.php',
    'migrations\IngredientsTableMigration.php',
    'migrations\LanguagesTableMigration.php',
    'migrations\RecipesTableMigration.php',
    'migrations\TagsTableMigration.php',
];

$junctionMigrationFiles = [
    'migrations\IngredientJunctionTable.php',
    'migrations\TagJunctionTableMigration.php',
];

try {
    foreach ($nonJunctionMigrationFiles as $migrationFile) {
        require $migrationFile;
        echo "Migration script $migrationFile executed successfully." . PHP_EOL;
    }

    foreach ($junctionMigrationFiles as $migrationFile) {
        require $migrationFile;
        echo "Migration script $migrationFile executed successfully." . PHP_EOL;
    }
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}

echo "All migrations completed successfully." . PHP_EOL;
