<?php

namespace App\Controller;

use App\Entity\Color;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ColorController extends AbstractController
{
    #[Route('/colors', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $colors = $entityManager->getRepository(Color::class)->findAll();
        return $this->json(
            $colors,
            200,
            [],
            ['groups' => ['color:read']]
        );
    }
}
