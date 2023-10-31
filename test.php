<?php
require __DIR__ . '/models/RecipeModel.php'; // Adjust the path as needed

$database = new Database();
$db = $database->Connect();
$recipeModel = new RecipeModel($db);

$recipes = $recipeModel->getRecipes();

if ($recipes !== null) {
    echo json_encode($recipes, JSON_PRETTY_PRINT);
} else {
    echo "Failed to retrieve recipes.";
}