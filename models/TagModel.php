<?php

include_once 'config/Database.php';

class TagModel
{
    private $db;
    private $tag_id;
    private $titleEn;
    private $titleDe;
    private $titleFr;
    private $slug;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function populate($tag_id, $slug, $titleEn, $titleDe, $titleFr)
    {
        $this->tag_id = $tag_id;
        $this->titleEn = $titleEn;
        $this->titleDe = $titleDe;
        $this->titleFr = $titleFr;
        $this->slug = $slug;
    }
}
