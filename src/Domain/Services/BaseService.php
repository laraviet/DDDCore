<?php

namespace Laraviet\DDDCore\Domain\Services;

use Laraviet\DDDCore\Domain\Entities\NullEntity;

abstract class BaseService implements ServiceInterface
{
    protected $repository;
    protected $validator;

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function persist($request, $id = null)
    {
        $this->validator->validate($request);
        if (isset($id)){
            $entity = $this->getById($id);
        } else {
            $entity = new NullEntity;
        }
        return $this->repository->persist($entity);
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