<?php

namespace Laraviet\DDDCore\Persistence\Eloquent;

use Laraviet\DDDCore\Domain\Repositories\RepositoryInterface;
use Illuminate\Validation\ValidationException;


abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function begin()
    {
        throw new \Exception('Method not implemented');
    }

    public function commit()
    {
        throw new \Exception('Method not implemented');
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function paginate($quantity = null)
    {
        $per_page = isset($quantity) ? $quantity : 10;
        return $this->model->paginate($per_page);
    }

    public function persist($model)
    {
        if ($model != null) {
            $success = $model->updateUniques();
        } else {
            $model = $this->model;
            $success = $model->save();
        }

        if (!$success) {
            throw new ValidationException($model);
        }
        return $model;
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function identity()
    {
        $reflector = new \ReflectionClass($this->model);
        return $reflector->getName();
    }

}