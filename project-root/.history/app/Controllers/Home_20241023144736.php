<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('templates/header').view('welcome_message').view('templates/footer');
    }
}
