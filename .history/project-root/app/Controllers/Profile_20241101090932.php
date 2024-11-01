<?php

namespace App\Controllers;

use App\Models\User_model;

class Profile extends BaseController{

    public function index(){
        return $this->getProfileDatas();
    }

    public function getProfileDatas(){
        $data = [];
        $user_model = new User_model();
        
        return $this->loadPage("user/profile",$data);
    }

    public function loadPage($page,$data = []){
        return view("templates/header").view($page,$data).view("templates/footer");
    }
}
?>