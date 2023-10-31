<?php

include_once 'config/Database.php';

class CategoryModel
{
    private $db;
    private $category_id;
    private $titleEn;
    private $titleDe;
    private $titleFr;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($category_id, $slug, $titleEn, $titleDe, $titleFr)
    {
        $this->category_id = $category_id;
        $this->titleEn = $titleEn;
        $this->titleDe = $titleDe;
        $this->titleFr = $titleFr;
        $this->slug = $slug;
    }
}
