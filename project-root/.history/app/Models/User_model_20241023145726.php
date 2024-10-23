<?php
namespace App\Models;
use CodeIgniter\Model;


class User_model extends Model{

    protected $table = "user";
    protected $allowedFields = ["first_name","last_name","email","password","admin","created"];

    public function regUser($data){
        return $this->insert($data);
    }
    
}

?>