<?php

namespace Laraviet\DDDCore\Book\Domain\Repositories;

use Laraviet\DDDCore\Book\Domain\Entities\AbstractEntity;

interface RepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function paginate($quantity = null);
    public function persist(AbstractEntity $entity);
    public function begin();
    public function commit();
}