<?php

namespace App\Controller;

use App\Entity\Salon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SalonController extends AbstractController
{
    #[Route('/salons', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $salons = $entityManager->getRepository(Salon::class)->findAll();
        return $this->json(
            $salons,
            200,
            [],
            ['groups' => ['salons:read']]
        );
    }
}
