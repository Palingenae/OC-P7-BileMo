<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProductRepository;
use Normalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class ProductController extends AbstractController
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listAllProducts(NormalizerInterface $normalizer)
    {
        try {
            $products = $this->repository->findAll();

            $normalizedProducts = $normalizer->normalize($products, 'json', ['groups' => ['products', 'partners']]);

            return new JsonResponse($normalizedProducts, 200);
        } catch (Throwable) {
            return new JsonResponse(
                ['errors' => ['Something is wrong. Please check again.']],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}