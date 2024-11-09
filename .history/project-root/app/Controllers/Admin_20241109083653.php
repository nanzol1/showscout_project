<?php

namespace App\Controllers;

use App\Models\Media_model;
use App\Models\User_model;

class Admin extends BaseController{
    public function index(){
        $userModel = new User_model();
        $mediaModel = new Media_model();
        $users = $userModel->getAllUser();
        if($users){
            $data['users'] = $users;
        }else{
            $data = [];
        }

        return $this->loadPage("user/admin",$data);
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>