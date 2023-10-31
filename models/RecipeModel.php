<?php

require __DIR__ . '/../config/Database.php';

class RecipeModel
{
    private $db;
    private $recipe_id;
    private $title;
    private $description;
    private $category_id;
    private $language_id;
    private $tags;
    private $ingredients;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($recipe_id, $title, $description, $category_id, $language_id, $tags, $ingredients)
    {
        $this->recipe_id = $recipe_id;
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->language_id = $language_id;
        $this->tags = $tags;
        $this->ingredients = $ingredients;
    }

    public function getRecipes()
    {
        $sql = "
    SELECT
        recipe.recipe_id,
        recipe.titleEn AS titleEn,
        recipe.titleDe AS titleDe,
        recipe.titleFr AS titleFr,
        recipe.descriptionEn AS descriptionEn,
        recipe.descriptionDe AS descriptionDe,
        recipe.descriptionFr AS descriptionFr,
        recipe.status,
        GROUP_CONCAT(DISTINCT category.titleEn) AS category_titleEn,
        GROUP_CONCAT(DISTINCT category.titleDe) AS category_titleDe,
        GROUP_CONCAT(DISTINCT category.titleFr) AS category_titleFr,
        GROUP_CONCAT(DISTINCT tag.titleEn) AS tag_titleEn,
        GROUP_CONCAT(DISTINCT tag.titleDe) AS tag_titleDe,
        GROUP_CONCAT(DISTINCT tag.titleFr) AS tag_titleFr,
        GROUP_CONCAT(DISTINCT ingredient.titleEn) AS ingredient_titleEn,
        GROUP_CONCAT(DISTINCT ingredient.titleDe) AS ingredient_titleDe,
        GROUP_CONCAT(DISTINCT ingredient.titleFr) AS ingredient_titleFr
    FROM recipes AS recipe
    LEFT JOIN recipe_tags AS recipe_tag ON recipe.recipe_id = recipe_tag.recipe_id
    LEFT JOIN tags AS tag ON recipe_tag.tag_id = tag.tag_id
    LEFT JOIN recipe_ingredients AS recipe_ingredient ON recipe.recipe_id = recipe_ingredient.recipe_id
    LEFT JOIN ingredients AS ingredient ON recipe_ingredient.ingredient_id = ingredient.ingredient_id
    LEFT JOIN categories AS category ON recipe.category_id = category.category_id
    GROUP BY recipe.recipe_id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function filterRecipes($per_page, $page, $category, $tags, $with, $lang, $diff_time, $recipes)
    {
        if ($recipes === null) {
            return null;
        }

        $filteredRecipes = [];

        $titleColumn = "title" . ucfirst($lang);
        $descriptionColumn = "description" . ucfirst($lang);

        foreach ($recipes as $recipe) {
            $recipeMatchesCategory = $category === null || ($category === 'NULL' && $recipe['category_id'] === null) || $recipe['category_id'] == $category;
            
            $recipeMatchesDiffTime = $diff_time === null || $recipe['updated_at'] >= $diff_time;

            if ($recipeMatchesCategory  && $recipeMatchesDiffTime) {
                $filteredRecipe = [
                    'recipe_id' => $recipe['recipe_id'],
                    'title' => $recipe[$titleColumn],
                    'description' => $recipe[$descriptionColumn],
                    'status' => $recipe['status'],
                ];

                if (in_array('category', explode(',', $with))) {
                    $filteredRecipe['category_title'] = $recipe["category_$titleColumn"];
                }

                if (in_array('tags', explode(',', $with))) {
                    $filteredRecipe['tag_title'] = $recipe["tag_$titleColumn"];
                }

                if (in_array('ingredients', explode(',', $with))) {
                    $filteredRecipe['ingredient_title'] = $recipe["ingredient_$titleColumn"];
                }

                $filteredRecipes[] = $filteredRecipe;
            }
        }

        $startIndex = ($page - 1) * $per_page;
        $filteredRecipes = array_slice($filteredRecipes, $startIndex, $per_page);

        return $filteredRecipes;
    }
}
