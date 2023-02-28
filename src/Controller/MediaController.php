<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    #[Route('/medias', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $medias = $entityManager->getRepository(Media::class)->findAll();
        return $this->json(
            $medias,
            200,
            [],
            ['groups' => ['media:read']]
        );
    }
}
