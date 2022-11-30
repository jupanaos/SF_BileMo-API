<?php

namespace App\Doctrine;

use App\Entity\Customer;
use Symfony\Component\Security\Core\Security;

class CustomerSetUserListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function prePersist(Customer $customer)
    {
        if ($customer->getUser()) {
            return;
        }

        if ($this->security->getUser()) {
            $customer->setUser($this->security->getUser());
        }
    }
}