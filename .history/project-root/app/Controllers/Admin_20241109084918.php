<?php

namespace App\Controllers;

use App\Models\Media_model;
use App\Models\User_model;

class Admin extends BaseController{
    public function index(){
        $userModel = new User_model();
        $mediaModel = new Media_model();
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
        $mediaModel = new Media_model();
        if($this->request->getMethod() === "POST"){
            $film_title = $this->request->getPost('film_title') ?? '';
            $film_url = $this->request->getPost('film_url')  ?? '';
            $film_released = $this->request->getPost('film_released')  ?? '';
            $film_desc = $this->request->getPost('film_desc')  ?? '';
            $film_img = $this->request->getPost('film_img')  ?? '';

            if($film_title && $film_url && $film_released &&
            $film_desc && $film_img){
                $formData = [
                    'Title' => $film_title,
                    //'url' => $film_url,
                    'Description' => $film_desc,
                    'Released' => $film_released,
                    'Img_path' => $film_img,
                ];

            }
        }else{
            $formData = [];
            return redirect()->to(base_url('admin'))->with('error','Hiba történt a média feltöltésekor!');
        }
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>