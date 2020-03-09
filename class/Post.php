<?php

class Post
{
    //ATTRIBUTES CLASS
    
    protected $post_id,
              $us_id,   
              $title,
              $content,
              $chapo,
              $last_update;

    //GETTERS

    public function post_id() {
        return $this->$blog_id;
    }

    public function us_id() {
        return $this->$us_id;
    }

    public function title() {
        return $this->$title;
    }

    public function content() {
        return $this->$content;
    }

    public function chapo() {
        return $this->$chapo;
    }

    public function last_update() {
        return $this->$last_update;
    }

    //SETTERS

    public function setPost_id() {
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