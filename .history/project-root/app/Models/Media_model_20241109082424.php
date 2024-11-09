<?php

namespace App\Models;

use CodeIgniter\Model;

class Media_model extends Model
{
    protected $table = 'media';
    protected $allowedFields = ['Title', 'Description', 'Released', 'Img_path'];

    public function getAllMedia(){
        return $this->findAll();
    }

    public function getStreaming()
    {
        return $this->select('media.*, streamingservices.Name as StreamingProvider')
                    ->join('streamingservices', 'streamingservices.ID = media.Ss_id')
                    ->findAll();
    }


}
?>