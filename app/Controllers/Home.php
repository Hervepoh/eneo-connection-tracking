<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper('multi_language');
        // to be able to share session data (lang)
        $session = session();
        (new Language())->initLocale($this->request->getLocale());
  
        return view('welcome_message');
    }
}
