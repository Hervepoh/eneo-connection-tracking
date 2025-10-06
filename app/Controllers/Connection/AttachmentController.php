<?php

namespace App\Controllers\Connection;

use App\Models\AttachmentModel;
use CodeIgniter\Controller;

class AttachmentController extends Controller
{
    /**
     * Prévisualisation du fichier (affichage direct si image/pdf)
     */
    public function preview($id)
    {
        $model = new AttachmentModel();
        $attachment = $model->find($id);

        if (!$attachment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Fichier introuvable");
        }

        $filePath = $attachment['file'];
        if (!is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Fichier inexistant sur le serveur");
        }

        // Détection du type MIME
        $mimeType = mime_content_type($filePath);
        $response = service('response');
        $response->setHeader('Content-Type', $mimeType);
        $response->setBody(file_get_contents($filePath));

        return $response;
    }

    /**
     * Téléchargement sécurisé du fichier
     */
    public function download($id)
    {
        $model = new AttachmentModel();
        $attachment = $model->find($id);

        if (!$attachment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Fichier introuvable");
        }

        $filePath = $attachment['file'];
        if (!is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Fichier inexistant sur le serveur");
        }

        return $this->response->download($filePath, null)->setFileName($attachment['filename']);
    }
}
