<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['email','Password','Created', 'User_ID'];

    public function createAdmin($data){
        $userModel = new User_model();
        $users = $userModel->getAllUser();
        /*$adminData = [
            'Is_admin' => 1,
        ];
        foreach($users as $item){
            if($item['Email'] == $data['email']){
                $userModel->updateAdmin($data['User_ID'],$adminData);
            }
        }*/
        return $this->insert($data);
    }


}
?>