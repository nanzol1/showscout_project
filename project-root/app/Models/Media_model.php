<?php

namespace App\Models;

use CodeIgniter\Model;

class Media_model extends Model
{
    protected $table = 'media';
    protected $allowedFields = ['Title', 'Description', 'Released', 'Img_path'];
}
?>