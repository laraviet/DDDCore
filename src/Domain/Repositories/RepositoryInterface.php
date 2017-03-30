<?php

namespace Laraviet\DDDCore\Domain\Repositories;

use Laraviet\DDDCore\Domain\Entities\AbstractEntity;

interface RepositoryInterface
{
    public function begin();
    public function commit();
    public function getAll();
    public function getById($id);
    public function paginate($quantity = null);
    public function persist($model);
    public function destroy($id);
}