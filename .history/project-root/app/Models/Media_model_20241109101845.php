<?php

namespace App\Models;

use CodeIgniter\Model;

class Media_model extends Model
{
    protected $table = 'media';
    protected $allowedFields = ['Title','url', 'Description', 'Released', 'Img_path','Ss_id'];

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

    public function deleteMedia($mediaId){
        return $this->delete($mediaId);
    }
    public function findUserById($mediaId){
        return $this->where('ID',$userId)->first();
    }


}
?>