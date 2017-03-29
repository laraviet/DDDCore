<?php

namespace Laraviet\DDDCore\Domain\Repositories;

use Laraviet\DDDCore\Domain\Entities\AbstractEntity;

interface RepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function paginate($quantity = null);
    public function persist(AbstractEntity $entity);
    public function begin();
    public function commit();
    public function destroy($id);
}