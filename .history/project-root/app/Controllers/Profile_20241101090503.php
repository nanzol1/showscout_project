<?php

namespace App\Controllers;

class Profile extends BaseController{

    public function index($page,$data){
        return $this->loadPage($page,$data);
    }



    public function loadPage($page,$data = []){
        return view("templates/header").view($page,$data).view("templates/footer");
    }
}
?>