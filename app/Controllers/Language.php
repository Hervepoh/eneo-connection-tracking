<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;

class Language extends BaseController
{
    public function index()
    {
        //DOC: https://stackoverflow.com/questions/60250996/how-to-set-specific-language-for-all-pages-in-codeigniter-4
        //dd($this->request->getLocale());
        $this->setLocale($this->request->getLocale());
       
        $url = $_SERVER["HTTP_REFERER"]; 
        return redirect()->to($url);
    }

    public function setLocale(string $locale){
        $session = session();
        $session->remove('lang');
        $session->set('lang', $locale);   
    }

    public function initLocale(string $locale){
        $session = session();
        if (!$session->get('lang')){
            $session->remove('lang');
            $session->set('lang', $locale);
        }
       
    }
    
}