<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class UserNormalizer implements AbstractNormalizer
{
    public function __construct() {
    
    }

    public function __invoke($object)
    {
        return $object->getId();
    }
}