<?php

namespace App\Controller;

use App\Entity\Tatoueurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TatoueurController extends AbstractController
{
    #[Route('/tatoueurs', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $tatoueurs = $entityManager->getRepository(Tatoueurs::class)->findAll();
        return $this->json(
            $tatoueurs,
            200,
            [],
            ['groups' => ['tatoueurs:read']]
        );
    }
}
