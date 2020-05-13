<?php

namespace App\src\model;

/**
 * Class Picture
 */
class Picture
{

    private $id;
    private $path;

    /**
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * 
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return void
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * 
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}
