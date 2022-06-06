<?php
declare(strict_types=1);


namespace App\Controller;


use App\Entity\Batch;
use App\Repository\BatchRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatchController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BatchRepository $repository,
    ){}

    #[Route(path: '/batch', name: 'batch_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $requestBody = $request->toArray();
        $batch = (new Batch())
            ->setStatus($requestBody['status'])
            ->setNumBatch($requestBody['numBatch'])
            ;

        $this->entityManager->persist($batch);
        $this->entityManager->flush();

        return $this->json($batch, 201);
    }

    #[Route(path: '/batch', name: 'batch_find_all', methods: ['GET'])]
    public function findAll(): Response
    {
        $batches = $this->repository->findAll();

        return $this->json($batches);
    }

    #[Route(path: '/batch/{id}', name: 'batch_get', methods: ['GET'])]
    public function get(int $id): Response
    {
        $batch = $this->repository->find($id);

        if (null === $batch) {
            $errorResponse = [
                'error' => true,
                'message' => 'ААААА!!!!! Нету!!!',
            ];

            return $this->json(data: $errorResponse, status: 404);
        }

        return $this->json($batch);
    }

    #[Route(path: '/batch/{id}', name: 'batch_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $batch = $this->repository->find($id);

        if (null === $batch) {
            $errorResponse = [
                'error' => true,
                'message' => 'ААААА!!!!! Нету!!!',
            ];

            return $this->json(data: $errorResponse, status: 404);
        }

        try {
            $this->repository->remove($batch, true);
        } catch (\Exception $exception) {
            $errorResponse = [
                'error' => true,
                'message' => 'ААААА!!!!! Не получилось удалить батч!!!',
            ];

            return $this->json(data: $errorResponse, status: 404);
        }

        return new Response(null, 204);

    }

}
