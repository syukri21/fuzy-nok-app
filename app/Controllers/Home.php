<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Home/Home');
    }

    public function adminHome(): string
    {
        return view('Home/AdminHome');

    }
}
