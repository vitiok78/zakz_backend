<?php
declare(strict_types=1);


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(path: '/test', name: 'test_route', methods: ['GET'])]
    public function testRoute(): Response
    {
        $responseArray = ['hello' => 'world'];
        return $this->json($responseArray);
    }
}
