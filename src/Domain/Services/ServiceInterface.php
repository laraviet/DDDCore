<?php

namespace Laraviet\DDDCore\Book\Domain\Services;

interface ServiceInterface
{
    public function getById($id);
    public function getAll();
    public function paginate($quantity = null);
    public function persist($id, $request);
}