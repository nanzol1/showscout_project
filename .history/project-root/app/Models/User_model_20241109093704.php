<?php
namespace App\Models;
use CodeIgniter\Model;


class User_model extends Model{

    protected $table = "user";
    protected $allowedFields = ["First_name","Last_name","Username","Email","Password","Is_admin","Created"];

    public function regUser($data){
        return $this->insert($data);
    }

    public function getUserByEmail($email){
        return $this->where('Email',$email)->first();
    }

    public function updateUser($userId,$data = []){
        return $this->where('ID',$userId)->set($data)->update();
    }
    public function getAllUser(){
        return $this->findAll();
    }
    
    public function deleteUser($userId){
        return $this->delete($userId);
    }

    public function updateAdmin($userId,$data = []){
        return $this->where('ID',$userId)->set($data)->update();
    }
    
}

?>