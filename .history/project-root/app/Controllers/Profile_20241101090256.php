<?php

namespace App\Controllers;

class Profile extends BaseController{

    public function index($page){
        return $this->loadPage($page);
    }

    public function loadPage($page,$data = []){

    }
}
?>