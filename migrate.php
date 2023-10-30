<?php
require 'config/database.php';


$migrationFiles = [
    'migrations\CategoriesTableMigration.php',
    'migrations\IngredientJunctionTable.php',
    'migrations\IngredientsTableMigration.php',
    'migrations\LanguagesTableMigration.php',
    'migrations\RecipesTableMigration.php',
    'migrations\TagJunctionTableMigration.php',
    'migrations\TagsTableMigration.php'
];

try {
    foreach ($migrationFiles as $migrationFile) {
        require $migrationFile;
        echo "Migration script $migrationFile executed successfully." . PHP_EOL;
    }
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}

echo "All migrations completed successfully." . PHP_EOL;
