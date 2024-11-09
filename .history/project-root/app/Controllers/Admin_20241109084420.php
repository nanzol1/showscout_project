<?php

namespace App\Controllers;

use App\Models\Media_model;
use App\Models\User_model;

class Admin extends BaseController{
    public function index(){
        $userModel = new User_model();
        $medias = $mediaModel->getAllMedia();
        $users = $userModel->getAllUser();
        if($users){
            $data['users'] = $users;
        }else{
            $data = [];
        }
        $medias = $medias ? $data['medias'] = $medias : $data = [];

        return $this->loadPage("user/admin",$data);
    }

    public function createAdmin(){
        //TODO
    }

    public function createMedia(){
        if($this->request->getMethod() === "POST"){

        }
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>