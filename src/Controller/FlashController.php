<?php

namespace App\Controller;

use App\Entity\Flash;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FlashController extends AbstractController
{
    #[Route('/flashs', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $flashs = $entityManager->getRepository(Flash::class)->findAll();
        return $this->json(
            $flashs,
            200,
            [],
            ['groups' => ['flashs:read']]
        );
    }
}
