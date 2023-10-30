<?php

include_once 'config/Database.php';

class IngredientModel
{
    private $db;
    private $ingredient_id;
    private $title;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($ingredient_id, $title, $slug)
    {
        $this->ingredient_id = $ingredient_id;
        $this->title = $title;
        $this->slug = $slug;
    }
}
