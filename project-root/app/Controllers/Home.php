<?php

namespace App\Controllers;
use App\Models\Media_model;
use CodeIgniter\Files\File;

class Home extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        return $this->loadMovies();
    }

    public function loadPage($page = 0, $data = []){
        return view('templates/header').view($page,$data).view('templates/footer');
    }

    public function loadMovies()
    {
        $moviesModel = new Media_model();
        $movies = $moviesModel->getStreaming();
        $data['movies'] = $movies;

        if (empty($data['movies'])) {
            return $movies = [];
        }

        return $this->loadPage('user/home', $data);
    }
}
?>