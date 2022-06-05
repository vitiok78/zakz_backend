<?php
declare(strict_types=1);


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route(path: '/test', name: 'test_post', methods: ['POST'])]
    public function testPost(Request $request, LoggerInterface $logger): Response
    {
        $requestData = $request->toArray();
        $logger->info(message: 'AAAAA Test request', context: $requestData);
        return $this->json($requestData);
    }
}
