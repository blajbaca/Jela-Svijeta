<?php

include_once 'config/Database.php';

class TagModel
{
    private $db;
    private $tag_id;
    private $title;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($tag_id, $title, $slug)
    {
        $this->tag_id = $tag_id;
        $this->title = $title;
        $this->slug = $slug;
    }
}
