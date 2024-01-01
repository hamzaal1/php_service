<?php

namespace App;

class Request
{
    private $get;
    private $post;
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }
    //  magic method in php called if we don't have the propiet that we trying to access ----- Note by hamza Demnani
    public function __get($name)
    {
        // Access both GET and POST variables
        if (isset($this->get[$name])) {
            return $this->get[$name];
        } elseif (isset($this->post[$name])) {
            return $this->post[$name];
        }
        return null;
    }
}

?>