<?php

namespace App;

class Post{
    
    public $id;

    public $name;

    public $content;

    public $create_at;

    public function __construct(){
        if (is_int($this->create_at) || is_string($this->create_at)){
            $this->create_at = new \DateTime('@' . $this->create_at);
        }
    }

    public function getExcerpt(): string
    
    {
        return substr($this->content, 0, 150);
    }

    public function getBody(): string
    
    {
       $parseDown = new \Parsedown();
       $parseDown->setSafeMode(true);
       return $parseDown->text($this->content);
    }

}