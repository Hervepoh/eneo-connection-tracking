<?php

namespace App\Controllers;

use App\Models\ConnectionModel;

class Home extends BaseController
{
    public function index()
    {
        helper('multi_language');
        // to be able to share session data (lang)
        session();
        (new Language())->initLocale($this->request->getLocale());

        $model = new ConnectionModel();
        $perPage = 10;

        // Récupération du paramètre 'search'
        $search = trim($this->request->getGet('search') ?? '');

        $data = [
            'requests' => $model->getRequestsWithAttachments($search, $perPage),
            'pager' => $model->pager,
            'search' => $search,
        ];

        return view('welcome_message', $data);
    }
}
