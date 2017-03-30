<?php

namespace Laraviet\DDDCore\Domain\Services;

use Laraviet\DDDCore\Domain\Entities\NullEntity;

abstract class BaseService implements ServiceInterface
{
    protected $repository;

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function persist($id = null)
    {
        $model = isset($id) ? $this->getById($id) : null;

        return $this->repository->persist($model);
    }

    public function paginate($quantity = null)
    {
        return $this->repository->paginate($quantity);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}