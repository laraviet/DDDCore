<?php

namespace Laraviet\DDDCore\Book\Domain\Entities;

interface ValidatorInterface
{
    public function validate($request);
}