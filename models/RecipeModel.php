<?php

include_once 'config/Database.php';

class RecipeModel
{
    private $db;
    private $recipe_id;
    private $title;
    private $description;
    private $category_id;
    private $language_id;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($recipe_id, $title, $description, $category_id, $language_id)
    {
        $this->recipe_id = $recipe_id;
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->language_id = $language_id;
    }
}
