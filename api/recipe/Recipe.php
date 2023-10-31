<?php

require 'config/Database.php';
require 'models/RecipeModel.php';

$database = new Database();
$db = $database->Connect();

$recipeModel = new RecipeModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $category = isset($_GET['category']) ? (int)$_GET['category'] : null;
    $tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : null;
    $with = isset($_GET['with']) ? $_GET['with'] : null;
    $lang = isset($_GET['lang']) ? $_GET['lang'] : null;
    $diff_time = isset($_GET['diff_time']) ? (int)$_GET['diff_time'] : null;

    if ($lang === null) {
        http_response_code(400); 
        echo json_encode(array("error" => "The 'lang' parameter is required."));
        exit;
    }

    $recipes = $recipeModel->filterRecipes($per_page, $page, $category, $tags, $with, $lang, $diff_time);

    echo json_encode($recipes);
}
