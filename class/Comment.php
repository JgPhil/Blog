<?php

class Comment
{
    //ATTRIBUTES CLASS

    private $com_id;
    private $blog_id;
    private $us_id;
    private $com_date;
    private $publish; //boolean


    //GETTERS

    public function getCom_id() {
       return $this->$com_id;
    }

    public function getBlog_id() {
        return $this->$blog_id;
    }

    public function getUs_id() {
        return $this->$us_id;
     }
 
    public function getCom_date() {
        return $this->$com_date;
    }
    public function getPublish() {
        return $this->$publish;
    }

    //SETTERS

    public function setCom_id() {
        $this->com_id = $com_id;
    }

    public function setBlog_id() {
        $this->blog_id = $blog_id;
    }

    public function setUs_id() {
        $this->us_id = $us_id;
     }

    public function setCom_date() {
        $this->com_date = $com_date;
    }
    public function setPublish() {
        $this->publish = $publish;
    }
  
}