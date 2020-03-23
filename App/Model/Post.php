<?php

namespace App\Model;

class Post
{
    //ATTRIBUTES CLASS
    
    protected $post_id,
              $user_id,   
              $title,
              $content,
              $heading,
              $last_update;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }         

    //GETTERS

    public function post_id() {
        return $this->$blog_id;
    }

    public function user_id() {
        return $this->$user_id;
    }

    public function title() {
        return $this->$title;
    }

    public function content() {
        return $this->$content;
    }

    public function heading() {
        return $this->$chapo;
    }

    public function last_update() {
        return $this->$last_update;
    }

    //SETTERS

    public function setPost_id() {
        $this->post_id = $post_id;
    }

    public function setUser_id() {
        $this->user_id = $user_id;
    }

    public function setTitle() {
        $this->title = $title;
    }

    public function setContent() {
        $this->content = $content;
    }

    public function setHeading() {
        $this->heading = $heading;
    }

    public function setLast_update() {
        $this->last_update = $last_update;
    }    
}