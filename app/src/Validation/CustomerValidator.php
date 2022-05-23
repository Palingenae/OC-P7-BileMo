<?php

declare(strict_types=1);

namespace App\Validation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Webmozart\Assert\Assert as AssertAssert;

class CustomerValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data): ConstraintViolationListInterface
    {
        $validations = new Assert\Collection([
            'name' => [
                new Assert\NotBlank(),
                new Assert\Length([
                'min' => 2,
                'max' => 50,
            ])],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => 8,
                    'max' => 64
            ])],
            'postalAddress' => [
                new Assert\NotBlank(),
            ],
            'phoneNumber' => [
                new Assert\NotBlank(),
            ],
            'reseller' => [
                new Assert\NotBlank(),
                new Assert\Regex(
                    pattern: "/\d+/",
                    message: "Cette valeur doit être un nombre"
                )
            ]
        ]);

        return $this->validator->validate($data, $validations);
    }
}