<?php


namespace Controllers;


abstract class PublicController
{
    public function __construct()
    {
   
    }


    protected function isPostBack(): bool
    {
        return $_SERVER["REQUEST_METHOD"] === "POST";
    }
}
