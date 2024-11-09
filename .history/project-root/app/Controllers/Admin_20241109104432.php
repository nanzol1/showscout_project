<?php

namespace App\Controllers;

use App\Models\Admin_model;
use App\Models\Media_model;
use App\Models\Streamingservice_model;
use App\Models\User_model;
use CodeIgniter\Files\File;

class Admin extends BaseController{
    protected $helpers = ['form'];
    public function index(){
        $userModel = new User_model();
        $mediaModel = new Media_model();
        $medias = $mediaModel->getAllMedia();
        $users = $userModel->getAllUser();
        $ssModel = new Streamingservice_model();
        $sservices = $ssModel->getAllServices();
        $users = $users ? $data['users'] = $users : $data = [];
        $medias = $medias ? $data['medias'] = $medias : $data = [];
        $sservices = $sservices ? $data['services'] = $sservices : $data = [];

        return $this->loadPage("user/admin",$data);
    }

    public function createAdmin(){
        $adminModel = new Admin_model();
        if($this->request->getMethod() === "POST"){
            $admin_email = $this->request->getPost('admin_email') ?? '';
            $admin_password = $this->request->getPost('admin_password') ?? '';
            $admin_userId = $this->request->getPost('admin_userId') ?? '';
            if($admin_email && $admin_password){
                $formData = [
                    'email' => $admin_email,
                    'Password' => password_hash($admin_password,PASSWORD_DEFAULT),
                    'User_ID' => $admin_userId,
                ];

                if($adminModel->createAdmin($formData)){
                    return redirect()->to(base_url('admin'))->with('success','Admin sikeresen létrehozva!');
                }else{
                    return redirect()->to(base_url('admin'))->with('success','Sikertelen admin létrehozás!');
                }
            }
        }
        return $this->index();

    }

    public function createMedia(){
        $mediaModel = new Media_model();
        $formData = [];
        if($this->request->getMethod() === "POST"){
            $film_title = $this->request->getPost('film_title') ?? '';
            $film_url = $this->request->getPost('film_url')  ?? '';
            $film_released = $this->request->getPost('film_released')  ?? '';
            $film_desc = $this->request->getPost('film_desc')  ?? '';
            //$film_img = $this->request->getPost('film_img')  ?? '';
            $film_ssid = $this->request->getPost('sservices')  ?? '';

            $validationRule = [
                'userfile' => [
                    'label' => 'Movice pic',
                    'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[userfile,100]',
                        'max_dims[userfile,1024,768]',
                    ],
                ],
            ];
            if (!$this->validateData([], $validationRule)) {
                $data = ['errors' => $this->validator->getErrors()];
    
                var_dump("Sikertelen");

            }
    
            $img = $this->request->getFile('userfile');
    
            if (!$img->hasMoved()) {
                //$filepath = 'assets/images/' . $img->store();
                $newName = $img->getRandomName();
                $img->move(WRITEPATH.'images/', $img);
    
                //$data = ['uploaded_fileinfo' => new File($filepath)];
    
                //var_dump($filepath);
            }
    
            $data = ['errors' => 'The file has already been moved.'];

            if($film_title && $film_url && $film_released &&
            $film_desc && $film_ssid){
                $formData = [
                    'Title' => $film_title,
                    'url' => $film_url,
                    'Description' => $film_desc,
                    'Released' => $film_released,
                    'Img_path' => $img,
                    'Ss_id' => $film_ssid,
                ];


                if($mediaModel->createMedia($formData)){
                    return redirect()->to(base_url('admin'))->with('success','Sikeres média feltöltés!');
                }else{
                    return redirect()->to('admin')->with('error','Hiba történt a média feltöltése során!');
                }
            }
        }else{
            $formData = [];
            return redirect()->to(base_url('admin'))->with('error','Hiba történt a média feltöltésekor!');
        }

        return $this->index();

    }

    public function deleteUser($id){
        $userModel = new User_model();
        if($this->request->getMethod() === "POST"){
            $user = $userModel->findUserById($id);
            if($user){
                $userModel->deleteUser($id);
                return $this->response->setJSON(['success' => true, 'message' => "Felhasználó sikeresen törölve lett!"]);
            }else{
                return $this->response->setJSON(['error' => true, 'message' => "A felhasználó nem lett törölve!"]);
            }
        }
    }

    public function deleteMedia($id){
        $mediaModel = new Media_model();
        if($this->request->getMethod() === "POST"){
            $media = $mediaModel->findMediaById($id);
            if($media){
                $mediaModel->deleteMedia($id);
                return $this->response->setJSON(['success' => true, 'message' => "Film/sorozat sikeresen törölve lett!"]);
            }else{
                return $this->response->setJSON(['error' => true, 'message' => "A film/sorozat nem lett törölve!"]);
            }
        }
    }


    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }
}
?>