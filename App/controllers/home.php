<?php

class home extends Controller
{
    public function index()
    {
        $this->view('landingpage/Front');
    }

    public function AboutUs()
    {
        $this->view('landingpage/about');
    }

    public function ContactUs()
    {
        $this->view('landingpage/contact');
    }

    
}