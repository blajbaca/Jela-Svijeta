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
            category.title AS category_title,
            tag.title AS tag_title,
            ingredient.title AS ingredient_title
        FROM recipes AS recipe
        LEFT JOIN recipe_tags AS recipe_tag ON recipe.recipe_id = recipe_tag.recipe_id
        LEFT JOIN tags AS tag ON recipe_tag.tag_id = tag.tag_id
        LEFT JOIN recipe_ingredients AS recipe_ingredient ON recipe.recipe_id = recipe_ingredient.recipe_id
        LEFT JOIN ingredients AS ingredient ON recipe_ingredient.ingredient_id = ingredient.ingredient_id
        LEFT JOIN categories AS category ON recipe.category_id = category.category_id
        ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return null;
        }
    }

    function filterRecipes($per_page, $page, $category, $tags, $with, $lang, $diff_time)
    {
        $database = new Database();
        $db = $database->Connect();

        $titleColumn = "title" . ucfirst($lang);
        $descriptionColumn = "description" . ucfirst($lang);

        $columns = [
            "recipe.recipe_id",
            "recipe.$titleColumn AS title",
            "recipe.$descriptionColumn AS description",
            "recipe.status",
        ];

        if (in_array('category', explode(',', $with))) {
            $columns[] = "category.$titleColumn AS category_title";
        }

        if (in_array('tags', explode(',', $with))) {
            $columns[] = "tag.$titleColumn AS tag_title";
        }

        if (in_array('ingredients', explode(',', $with))) {
            $columns[] = "ingredient.$titleColumn AS ingredient_title";
        }

        $selectClause = implode(', ', $columns);

        $sql = "SELECT $selectClause
    FROM recipes AS recipe
    LEFT JOIN recipe_tags AS recipe_tag ON recipe.recipe_id = recipe_tag.recipe_id
    LEFT JOIN tags AS tag ON recipe_tag.tag_id = tag.tag_id
    LEFT JOIN recipe_ingredients AS recipe_ingredient ON recipe.recipe_id = recipe_ingredient.recipe_id
    LEFT JOIN ingredients AS ingredient ON recipe_ingredient.ingredient_id = ingredient.ingredient_id
    LEFT JOIN categories AS category ON recipe.category_id = category.category_id
    WHERE recipe.language_id = :lang";

        if ($category !== null) {
            $sql .= " AND category.category_id " . ($category === 'NULL' ? 'IS NULL' : "= :category");
        }

        if ($tags !== null) {
            $sql .= " AND tag.tag_id IN (" . implode(',', $tags) . ")";
        }

        $sql .= " LIMIT :per_page OFFSET :offset";

        if ($diff_time !== null) {
            $sql .= " AND recipe.updated_at >= :diff_time";
        }

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':lang', $lang);
            $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
            $offset = ($page - 1) * $per_page;
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            if ($category !== null && $category !== 'NULL') {
                $stmt->bindParam(':category', $category);
            }
            if ($diff_time !== null) {
                $stmt->bindParam(':diff_time', $diff_time, PDO::PARAM_INT);
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo ("Failed: " . $e->getMessage());
        }
    }
}
