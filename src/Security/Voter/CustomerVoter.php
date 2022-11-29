<?php

namespace App\Security\Voter;

use App\Entity\Customer;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CustomerVoter extends Voter
{
    public const CUSTOMER_MANAGE = 'CUSTOMER_MANAGE';

    public function __construct(private Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::CUSTOMER_MANAGE])
            && $subject instanceof Customer;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser()->getUserIdentifier();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var Customer $customer */
        $customer = $subject;

        return match($attribute) {
            self::CUSTOMER_MANAGE => $this->canAccess($customer, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canAccess(Customer $customer, User $user): bool
    {
        return $user === $customer->getUser()->getUserIdentifier();
    }

}
