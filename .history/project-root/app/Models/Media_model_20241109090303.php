<?php

namespace App\Models;

use CodeIgniter\Model;

class Media_model extends Model
{
    protected $table = 'media';
    protected $allowedFields = ['Title', 'Description', 'Released', 'Img_path','Ss_id'];

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
        if (!empty($data['Ss_id'])) {
            $streamingServiceModel = new \App\Models\Streamingservice_model();
            $streamingService = $streamingServiceModel->findAll();
            $ssid = $streamingService['ID'];
    
            if (!$streamingService) {
                // Return false or handle the error if Ss_id is invalid
                return false;
            }
        }
        return $this->insert($data);
    }


}
?>