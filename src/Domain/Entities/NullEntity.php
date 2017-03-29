<?php

namespace Laraviet\DDDCore\Domain\Entities;

class NullEntity extends AbstractEntity
{
    public function __construct()
    {
        $this->setId(0);
    }
}