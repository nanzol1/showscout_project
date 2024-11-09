<?php

namespace App\Models;

use CodeIgniter\Model;

class Streamingservice_model extends Model
{
    protected $table = 'streamingservices';
    protected $allowedFields = ['Name', 'Link', 'Lowest_price_plan'];

    public function getAllMedia(){
        return $this->findAll();
    }

    public function getStreaming()
    {
        return $this->select('media.*, streamingservices.Name as StreamingProvider')
                    ->join('streamingservices', 'streamingservices.ID = media.Ss_id')
                    ->findAll();
    }

    public function createMedia($data){
        return $this->insert($data);
    }


}
?>