<?php

namespace App\Controllers;

class Profile extends BaseController{

    public function index(){
        return $this->loadPage();
    }

    public function getProfileDatas(){
        
    }

    public function loadPage(){
        return view("templates/header").view("user/profile").view("templates/footer");
    }
}
?>