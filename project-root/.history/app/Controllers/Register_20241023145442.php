<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class Register extends BaseController{


    public function index(){
        return $this->regUser();
    }

    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}

?>