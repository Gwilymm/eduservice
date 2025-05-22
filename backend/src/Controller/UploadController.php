<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/api/upload', name: 'api_upload_file', methods: ['POST'])]
    public function upload(Request $request): JsonResponse
    {
        $file = $request->files->get('file');

        if (!$file) {
            return $this->json(['error' => 'No file uploaded'], 400);
        }

        // Génère un nom de fichier unique
        $filename = uniqid() . '.' . $file->guessExtension();

        // Déplace le fichier dans /public/uploads (le dossier doit exister)
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads';

        try {
            $file->move($uploadDir, $filename);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Failed to move uploaded file'], 500);
        }

        // Renvoie l'URL relative vers le fichier uploadé
        return $this->json(['url' => '/uploads/' . $filename]);
    }
}
