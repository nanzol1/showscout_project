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
            $data['pid'] = session()->get('user_id');
            $data['profile_img'] = $userModel->getUserByEmail($user['email'])['profile_img'];
            $path = WRITEPATH . '../public/assets/images/profile/default';
            $images = [];

            if (is_dir($path)) {
                $files = scandir($path);
                foreach ($files as $file) {
                    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                        $images[] = $file;
                    }
                }
            }
            $data['images'] = $images;
            $data['isDefault'] = in_array($data['profile_img'],$images) ? true : false;

            return $this->loadPage("user/profile",$data);
        }
        $this->response->setStatusCode(403);
        $message = [
            'message' => "Nincs hozzáférésed ehhez a tartalomhoz",
        ];
        return view('errors/html/error_403',$message);
    }


    public function updateUser(){
        $userModel = new User_model();
        if($this->request->getMethod() === "POST"){
            $userDatas = session()->get();
            $modelDatas = $userModel->getUserByEmail($userDatas['email']);
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $isChanged = false;


            if($username != $userDatas['username']){
                session()->set('username',$username);
                $userModel->updateUser($userDatas['user_id'],['Username' => $username]);
                $isChanged = true;
            }
            if($email != $userDatas['email']){
                session()->set('email',$email);
                $userModel->updateUser($userDatas['user_id'],['Email' => $email]);
                $isChanged = true;
            }
            if(!empty($password)){
                if(password_verify($password,$modelDatas['Password'])){
                    redirect()->to(base_url('profile'))->with('error','A jelszó nem egyezhet meg az előzővel!'); 
                }else{
                    $userModel->updateUser($userDatas['user_id'],['Password' => password_hash($password,PASSWORD_DEFAULT)]);
                    $isChanged = true;
                }
            }
            if($isChanged){
                return redirect()->to(base_url('profile'))->with('success','Sikeresen adat változtatás');
            }else{
                return redirect()->to(base_url('profile'));
            }
        }
    }

    public function updateUserPicture($id){
        $userModel = new User_model();
        if($this->request->getMethod() === "POST"){
            $img = $this->request->getFile('userfile');
            if($img){
                $validationRule = [
                    'userfile' => [
                        'label' => 'Profile Picture',
                        'rules' => [
                            'uploaded[userfile]',
                            'is_image[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                            'max_size[userfile,200]',
                            'max_dims[userfile,200,200]',
                        ],
                    ],
                ];
                if (!$this->validateData([], $validationRule)) {
                    $data = ['errors' => $this->validator->getErrors()];

                    return redirect()->to(base_url('profile'))->with('error','Hiba történt!');
                }

            
                        
                if (!$img->hasMoved()) {
                    $newName = $img->getRandomName() ?? '';
                    $img->move('assets/images/profile/', $newName);
                }

            
                $data = ['errors' => 'The file has already been moved.'];
                $id = session()->get('user_id');
                $userData = [
                    'profile_img' => $newName,
                ];
                $userModel->updateUser($id,$userData);
                session()->set('profile_img',$newName);
                return redirect()->to(base_url('profile'))->with('succes','Sikeres');
                
            }else{
                $profileIMG = $this->request->getPost('profile_img');
                $id = session()->get('user_id');
                $userData = [
                    'profile_img' => $profileIMG,
                ];
                $userModel->updateUser($id,$userData);
                
                return redirect()->to(base_url('profile'))->with('succes','Sikeres');

            }

        }
    }

    public function loadPage($page,$data = []){
        return view("templates/header").view($page,$data).view("templates/footer");
    }
}
?>