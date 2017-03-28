<?php

namespace Laraviet\DDDCore\Book\Persistence\Eloquent\Mapping;

use Illuminate\Database\Eloquent\Model;
use Laraviet\DDDCore\Book\Domain\Entities\AbstractEntity;

class ItemMapping
{
    protected $entity;
    protected $model;

    public function __construct(AbstractEntity $entity,Model $model)
    {
        $this->entity = $entity;
        $this->model = $model;
    }

    public function ModelToEntity()
    {
        foreach ($this->entity->getAllProperties() as $property) {
            if (isset($this->model->$property)) {
                $method = "set" . ucfirst($property);
                $this->entity->$method($this->model->$property);
            }
        }

        return $this->entity;
    }

    private function fromUI() {
        foreach ($this->entity->getAllProperties() as $property) {
            $input = \Request::input($property);
            if ($input != null) {
                $method = "set" . ucfirst($property);
                $this->entity->$method($input);
            }
        }

        return $this;
    }

    public function EntityToModel()
    {
        $this->fromUI();
        foreach ($this->entity->getAllProperties() as $property) {
            if (isset($this->model->$property)) {
                $method = "get" . ucfirst($property);
                $this->model->$property = $this->entity->$method();
            }
        }

        return $this->model;
    }
}