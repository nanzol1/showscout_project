<?php

    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\User_model;
    use CodeIgniter\I18n\Time;


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
            $username = $this->request->getPost("username");
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");
            $now = Time::now('Europe/Budapest','hu_HU');

            if($username && $email){
                $formData = [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password,PASSWORD_DEFAULT),
                    'created' => $now->toDateString(),
                ];

                if($regModel->regUser($formData)){
                    return redirect()->to('/login');
                }else{
                    return redirect()->to('/register')->with('error','Hiba történt a regisztráció során!');
                }
            }else{
                $formData = [];
            }
        }
        return $this->loadPage('user/register',$formData);
    }
}

?>