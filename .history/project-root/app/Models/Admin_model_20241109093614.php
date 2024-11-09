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
        if($users['Email'] == $data['email']){
            
        }
        return $this->insert($data);
    }


}
?>