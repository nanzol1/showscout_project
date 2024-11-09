<?php

namespace App\Models;

use CodeIgniter\Model;

class Streamingservice_model extends Model
{
    protected $table = 'streamingservices';
    protected $allowedFields = ['Name', 'Link', 'Lowest_price_plan'];

    public function getAllServices(){
        return $this->findAll();
    }


}
?>