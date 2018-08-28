<?php

class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['title'] = 'Home page';
        $data['description'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto beatae commodi corporis doloremque';

        $this->view('pages.index', $data);
    }

    public function about()
    {
        $data['title'] = 'About page';
        $data['description'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto beatae commodi corporis doloremque';

        $this->view('pages.about', $data);
    }
}