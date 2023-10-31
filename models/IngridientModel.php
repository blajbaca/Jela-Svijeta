<?php

require __DIR__ . '/../config/Database.php';

class IngredientModel
{
    private $db;
    private $ingredient_id;
    private $titleEn;
    private $titleDe;
    private $titleFr;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($ingredient_id, $slug, $titleEn, $titleDe, $titleFr)
    {
        $this->ingredient_id = $ingredient_id;
        $this->titleEn = $titleEn;
        $this->titleDe = $titleDe;
        $this->titleFr = $titleFr;
        $this->slug = $slug;
    }
}
