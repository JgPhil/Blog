<?php

class Blog
{
    //ATTRIBUTES CLASS
    
    private $blog_id;
    private $us_id;   
    private $title;
    private $content;
    private $chapo;
    private $last_update;

    //GETTERS

    public function getBlog_id() {
        return $this->$blog_id;
    }

    public function getUs_id() {
        return $this->$us_id;
    }

    public function getTitle() {
        return $this->$title;
    }

    public function getContent() {
        return $this->$content;
    }

    public function getChapo() {
        return $this->$chapo;
    }

    public function getLast_update() {
        return $this->$last_update;
    }

    //SETTERS

    public function setBlog_id() {
        $this->blog_id = $blog_id;
    }

    public function setUs_id() {
        $this->us_id = $us_id;
    }

    public function setTitle() {
        $this->title = $title;
    }

    public function setContent() {
        $this->content = $content;
    }

    public function setChapo() {
        $this->chapo = $chapo;
    }

    public function setLast_update() {
        $this->last_update = $last_update;
    }    
}