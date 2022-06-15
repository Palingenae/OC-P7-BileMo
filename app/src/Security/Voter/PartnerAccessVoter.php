<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\Partner;
use App\Entity\Customer;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PartnerAccessVoter extends Voter
{
    const CREATE = 'create';
    const READ = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::CREATE, self::READ, self::UPDATE, self::DELETE]) && $subject instanceof Customer;
    }

    public function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        /** @var Customer $subject */
        $user = $token->getUser();

        if(!$user instanceof UserInterface) {
            return false;
        }

        $conditions = $subject->getReseller() === $user && $user->getRoles == ['ROLES_PARTNER'];

        switch($attribute) {
            case self::CREATE:
                if($conditions) {
                    return true;
                }
                break;
            case self::READ:
                if($conditions) {
                    return true;
                }
                break;
            case self::UPDATE:
                if($conditions) {
                    return true;
                }
                break;
            case self::DELETE:
                if($conditions) {
                    return true;
                }
                break;
        }

        return false;
    }
}