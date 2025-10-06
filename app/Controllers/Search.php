<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AttachmentModel;
use App\Models\ContractModel;


class Search extends BaseController
{
    public function index($identifier = null)
    {
        $response = null;

        if ($identifier === null) {
            $response = $this->response->setJSON([
                'status' => 'invalid_data',
                'message' => 'Veuillez préciser un numéro de contrat ou une référence de demande.'
            ])->setStatusCode(400);
        } else {
            $isContract = preg_match('/^\d{9}$/', $identifier);
            $isWorkRequest = preg_match('/^[PE]\d{14}$/', $identifier);

            if (!$isContract && !$isWorkRequest) {
                $response = $this->response->setJSON([
                    'status' => 'invalid_format',
                    'message' => 'Le numéro doit être soit 9 chiffres, soit 12 caractères alphanumériques.'
                ])->setStatusCode(422);
            } else {
                $model = new ContractModel();
                $data = null;

                if ($isContract) {
                    $data = $model->where('contract', $identifier)->first();
                } elseif ($isWorkRequest) {
                    $data = $model->where('work_request', $identifier)->first();
                }

                if (!$data) {
                    $response = $this->response->setJSON([
                        'status' => 'not_found',
                        'message' => 'Aucun résultat trouvé pour cette référence.'
                    ])->setStatusCode(404);
                } else {
                    $response = $this->response->setJSON([
                        'status' => 'success',
                        'data' => $data
                    ]);
                }
            }
        }

        return $response;
    }
}
