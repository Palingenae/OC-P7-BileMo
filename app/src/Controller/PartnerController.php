<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Partner;
use App\Repository\CustomerRepository;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PartnerController extends AbstractController
{
    private PartnerRepository $partnerRepository;
    private CustomerRepository $customerRepository;

    public function __construct(PartnerRepository $partnerRepository, ?CustomerRepository $customerRepository)
    {
        $this->partnerRepository = $partnerRepository;
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomersFromPartner(int $id, NormalizerInterface $normalizer): Response
    {
        $partner = $this->partnerRepository->find($id);

        if (!$partner instanceof Partner) {
            return new JsonResponse(
                ['errors' => "Le partenaire spécifié $id ne peut pas être trouvé."],
                Response::HTTP_NOT_FOUND
            );
        }

        $normalizedPartner = $normalizer->normalize($partner, 'json', ['groups' => ['partners', 'list_customers']]);

        return new JsonResponse($normalizedPartner, 200);
    }

    public function getOneCustomerFromPartner(int $partnerId, int $customerId, NormalizerInterface $normalizer): Response
    {
        $partner = $this->partnerRepository->find($partnerId);
        $customer = $this->customerRepository->find($customerId);

        $this->denyAccessUnlessGranted('read', $customer);

        if (!$partner instanceof Partner) {
            return new JsonResponse(
                ['errors' => "Le partenaire spécifié $partnerId ne peut pas être trouvé."],
                Response::HTTP_NOT_FOUND
            );
        }

        if (!$customer instanceof Customer) {
            return new JsonResponse(
                ['errors' => "Le client spécifié $customerId ne peut pas être trouvé."],
                Response::HTTP_NOT_FOUND
            );
        }

        $normalizedPartner = $normalizer->normalize($customer, 'json', ['groups' => ['reseller', 'one_customer']]);

        return new JsonResponse($normalizedPartner, 200);
    }
}
