<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PartnerController extends AbstractController
{
    private PartnerRepository $repository;

    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCustomersFromPartner(int $id, NormalizerInterface $normalizer): Response
    {
        $partner = $this->repository->find($id);

        if (!$partner instanceof Partner) {
            return new JsonResponse(
                ['errors' => "Le partenaire spécifié $id ne peut pas être trouvé."],
                Response::HTTP_NOT_FOUND
            );
        }

        $normalizedPartner = $normalizer->normalize($partner, 'json', ['groups' => ['partners', 'customers']]);

        return new JsonResponse($normalizedPartner, 200);
    }
}
