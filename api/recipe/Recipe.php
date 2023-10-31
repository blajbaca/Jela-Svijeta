<?php
require __DIR__ . '/../../models/RecipeModel.php';

$database = new Database();
$db = $database->Connect();

$recipeModel = new RecipeModel($db);
$recipes=$recipeModel->getRecipes();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $lang = isset($_GET['lang']) ? $_GET['lang'] : null;

    if ($lang === null) {
        http_response_code(400);
        echo json_encode(array("error" => "The 'lang' parameter is required."));
        exit;
    }

    $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
    $page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
    $category = isset($_GET['category']) ? (int)$_GET['category'] : null;
    $tags = isset($_GET['tags']) ? array_map('intval', explode(',', $_GET['tags'])) : null;
    $with = isset($_GET['with']) ? $_GET['with'] : null;
    $diff_time = isset($_GET['diff_time']) ? (int)$_GET['diff_time'] : null;

    $filteredRecipes = $recipeModel->filterRecipes($per_page, $page, $category, $tags, $with, $lang, $diff_time, $recipes);

    if ($filteredRecipes === null) {
        http_response_code(500);
        echo json_encode(array("error" => "Failed to retrieve recipes."));
    } else {
        echo json_encode($filteredRecipes);
    }
}
