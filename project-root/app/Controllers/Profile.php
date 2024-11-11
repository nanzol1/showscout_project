<?php

namespace App\Controllers;

use App\Models\User_model;

class Profile extends BaseController{

    public function index(){
        return $this->getProfileDatas();
    }

    public function getProfileDatas(){
        if(isUserLoggedIn()){
            $user = [
                'username' => session()->get('username'),
                'email' => session()->get('email'),
            ];
            $userModel = new User_model();
            $data['register_date'] = $userModel->getUserByEmail($user['email'])['Created'];
            $data['user'] = $user;
            return $this->loadPage("user/profile",$data);
        }
        return $this->response->setStatusCode(404)->setBody("Az oldalhoz nincs hozzáférésed!");
    }

    public function updateUser(){
        $userModel = new User_model();
        if($this->request->getMethod() === "POST"){
            $userDatas = session()->get();
            $modelDatas = $userModel->getUserByEmail($userDatas['email']);
            $dataChanged = [];
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if($username != $userDatas['username']){
                session()->set('username',$username);
                $userModel->updateUser($userDatas['user_id'],['Username' => $username]);
            }
            if($email != $userDatas['email']){
                session()->set('email',$email);
                $userModel->updateUser($userDatas['user_id'],['Email' => $email]);
            }
            if(password_verify($password,$modelDatas['Password'])){
                redirect()->to(base_url('profile'))->with('error','A jelszó nem egyezhet meg az előzővel!'); 
            }else{
                $userModel->updateUser($userDatas['user_id'],['Password' => password_hash($password,PASSWORD_DEFAULT)]);
            }
            return redirect()->to(base_url('profile'))->with('success','Sikeresen adat változtatás');
        }
    }

    public function loadPage($page,$data = []){
        return view("templates/header").view($page,$data).view("templates/footer");
    }
}
?>