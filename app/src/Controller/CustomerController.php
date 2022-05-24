<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Repository\PartnerRepository;
use App\Validation\CustomerValidator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class CustomerController extends AbstractController
{
    private CustomerRepository $customerRepository;
    private PartnerRepository $partnerRepository;

    public function __construct(CustomerRepository $customerRepository, ?PartnerRepository $partnerRepository) 
    {
        $this->customerRepository = $customerRepository;
        $this->partnerRepository = $partnerRepository;
    }

    public function createCustomer(Request $request, CustomerValidator $validator, PasswordHasherInterface $passwordHasher): Response
    {
        try {
            $data = $request->request->all();

            $errors = [];

            $violations = $validator->validate($data);

            if (0 !== count($violations))
            {
                foreach($violations as $violation) {
                    $errors[$violation->getPropertyPath()][] = $violation->getMessage();
                }

                return new JsonResponse(
                    ['errors' => $errors], 
                    Response::HTTP_BAD_REQUEST
                );
            }

            if ($this->partnerRepository->find($data['reseller']) === null)
            {
                return new JsonResponse([
                    'errors' => 'Impossible de créer cet utilisateur car son revendeur ne semble pas exister. Veuillez vérifier.'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $customer = new Customer();
            $customer->setName($data['name']);
            $customer->setEmail($data['email']);
            $customer->setPassword($passwordHasher->hash($data['password']));
            $customer->setPostalAddress($data['postalAddress']);
            $customer->setPhoneNumber($data['phoneNumber']);
            $customer->setReseller(
                $this->partnerRepository->find($data['reseller'])
            );

            $this->customerRepository->add($customer, true);

            return new JsonResponse(['message' => 'OK, utilisateur créé'], 201);
        } catch (Throwable) {
            return new JsonResponse(
                ['errors' => ['Désolés, quelque chose ne fonctionne pas']],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}