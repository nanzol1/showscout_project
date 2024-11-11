<?php
namespace App\Controllers;
use App\Models\User_model;
use CodeIgniter\Controller;
use CodeIgniter\I18n;

class Login extends BaseController
{
    public function index()
    {
        if (session()->has('user_id')){
            return redirect()-> to('/');
        }
        return $this->loadPage('user/login');
    }
    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new User_model();

        $user = $userModel->where('Username',$username)->first();

        if(!$user){
            return redirect()->back()->with('error','Hibás felhasználónév vagy jelszó')->withInput();
        }
        if(password_verify($password,$user['Password'])){
            session()->set([
                'user_id' => $user['ID'],
                'username' => $user['Username'],
                'first_name' => $user['First_name'],
                'last_name' => $user['Last_name'],
                'email' => $user['Email'],
            ]);
            return redirect()->to('/');
        }else{
            return redirect()->back()->with('error','Hibás felhasználónév vagy jelszó')->withInput();
        }
    }
    public function loadPage($page = 0,$data = [])
    {
        return view('templates/header') . view($page,$data) . view('templates/footer');
    }
    public function logout()
    {
        session()-> destroy();
        return redirect()->to('/login');
    }
}