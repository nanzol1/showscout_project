<?php

namespace App\Controllers;

class Admin extends BaseController{
    public function index(){
        return 0;
    }

    

    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>