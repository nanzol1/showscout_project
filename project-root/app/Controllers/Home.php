<?php

namespace App\Controllers;
use App\Models\Media_model;

class Home extends BaseController
{

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
        $data['movies'] = $moviesModel->findAll();

        if (empty($data['movies'])) {
            return redirect()->to('/register')->with('error', 'Nincs megjeleníthető film.');
        }

        return $this->loadPage('user/home', $data);
    }
}
?>