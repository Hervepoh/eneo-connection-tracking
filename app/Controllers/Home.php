<?php

namespace App\Controllers;

use App\Models\ConnectionModel;

class Home extends BaseController
{
    public function index()
    {
        helper('multi_language');
        // to be able to share session data (lang)
        $session = session();
        (new Language())->initLocale($this->request->getLocale());

        $model = new ConnectionModel();
        $perPage = 10;

        $search = $this->request->getGet('search');
        // $query = $model;

        // if (!empty($search)) {
        //     $query = $query
        //         ->groupStart()
        //         ->like('ticket_public', $search)
        //         ->orLike('firstname', $search)
        //         ->orLike('lastname', $search)
        //         ->orLike('taxnum', $search)
        //         ->groupEnd();
        // }

        // $data = [
        //     'requests' => $query->orderBy('created_at', 'DESC')->paginate($perPage),
        //     'pager' => $model->pager,
        //     'search' => $search,
        // ];

        $data = [
            'requests' => $model->getRequestsWithAttachments($search, $perPage),
            'pager' => $model->pager,
            'search' => $search,
        ];

        return view('welcome_message', $data);
    }
}
