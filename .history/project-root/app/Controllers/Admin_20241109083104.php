<?php

namespace App\Controllers;

class Admin extends BaseController{
    public function index(){
        $data = [];
        return loadPage("user/admin",$data);
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>