<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

class ProductController extends AbstractController
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listAllProducts(NormalizerInterface $normalizer): Response
    {
        try {
            $products = $this->repository->findAll();

            $normalizedProducts = $normalizer->normalize($products, 'json', ['groups' => ['products']]);

            return new JsonResponse($normalizedProducts, 200);
        } catch (Throwable) {
            return new JsonResponse(
                ['errors' => ['Quelque chose ne fonctionne pas, veuillez vérifier votre requête.']],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function getOneProduct(int $id, NormalizerInterface $normalizer): Response
    {
        try {
            $product = $this->repository->find($id);

            if (!$product instanceof Product) {
                return new JsonResponse(
                    ['errors' => "Le produit spécifié $id ne peut pas être trouvé."],
                    Response::HTTP_NOT_FOUND
                );
            }

            $normalizedProduct = $normalizer->normalize($product, 'json', ['groups' => ['products', 'partners']]);

            return new JsonResponse($normalizedProduct, Response::HTTP_OK);
        } catch (Throwable) {
            return new JsonResponse(
                ['errors' => ['Quelque chose ne fonctionne pas, veuillez vérifier votre requête.']],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
