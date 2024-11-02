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
        $sameData = [];
        $isDuplicate = false;
        if($this->request->getMethod() == "POST"){
            //$first_name = $this->request->getPost('first_name');
            //$last_name = $this->request->getPost('last_name');
            $username = $this->request->getPost("username");
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");
            $now = Time::now('Europe/Budapest','hu_HU');
            $users = $regModel->getAllUser();
            if(($username && $email)){
                foreach($users as $item){
                    if($username == $item['Username']){
                        return redirect()->back()->with('error','Ez a felhasználónév már foglalt!');
                    }elseif($email == $item['Email']){
                        return redirect()->back()->with('error','Ez az email cím már foglalt!');
                    }
                }
                if((preg_match("/^[a-zA-Z0-9][a-zA-Z0-9]{3,}$/",$username) 
                && preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/",$password)) 
                && !$isDuplicate){
                    $formData = [
                        'Username' => $username,
                        'Email' => $email,
                        'Password' => password_hash($password,PASSWORD_DEFAULT),
                        'Created' => $now->toDateString(),
                    ];
    
                    if($regModel->regUser($formData)){
                        return redirect()->to('/register');
                    }else{
                        return redirect()->to('/register')->with('error','Hiba történt a regisztráció során!');
                    }
                }else{
                    return redirect()->to('/register')->with('error','Hiba történt a regisztráció során!');
                }
            }else{
                $formData = [];
                return redirect()->to('/register')->with('error','Hiba történt a regisztráció során!');
            }
        }
        return $this->loadPage('user/register',$formData);
    }
}

?>