<?php

namespace App\Controllers;

use App\Models\User_model;

class Admin extends BaseController{
    public function index(){
        $userModel = new User_model();
        
        return $this->loadPage("user/admin",$data);
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>