<?php

include_once 'config/Database.php';

class CategoryModel
{
    private $db;
    private $category_id;
    private $title;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($category_id, $title, $slug)
    {
        $this->category_id = $category_id;
        $this->title = $title;
        $this->slug = $slug;
    }
}
