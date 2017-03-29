<?php

namespace Laraviet\DDDCore\Domain\Entities;

interface ValidatorInterface
{
    public function validate($request);
}