<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User_model;


class Register extends BaseController{


    public function index(){
        return $this->regUser();
    }

    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }

    public function regUser(){
        $regModel = new User_model();
        $formData = [];
        if($this->request->getMethod() == "POST"){
            $first_name = $this->request->getPost("first_name");
            $last_name = $this->request->getPost("last_name");
            $first_name = $this->request->getPost("first_name");
        }
    }
}

?>