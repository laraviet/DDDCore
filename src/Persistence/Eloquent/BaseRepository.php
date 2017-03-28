<?php

namespace Laraviet\DDDCore\Book\Persistence\Eloquent;

use Laraviet\DDDCore\Book\Domain\Entities\AbstractEntity;
use Laraviet\DDDCore\Book\Domain\Repositories\RepositoryInterface;
use Laraviet\DDDCore\Book\Persistence\Eloquent\Mapping\ItemMapping;
use Laraviet\DDDCore\Book\Persistence\Eloquent\Mapping\ArrayMapping;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $entity;

    public function commit()
    {
        throw new \Exception('Method not implemented');
    }

    public function begin()
    {
        throw new \Exception('Method not implemented');
    }

    public function getById($id)
    {
        $model = $this->model->findOrFail($id);
        $mapping = new ItemMapping($this->entity, $model);
        return $mapping->ModelToEntity();
    }

    public function getAll()
    {
        $books = $this->model->all();
        return $this->mapCollectionToArrayOfEntity($books);
    }

    public function paginate($quantity = null)
    {
        $per_page = isset($quantity) ? $quantity : 10;
        $books = $this->model->paginate($per_page);
        $collection = $this->mapCollectionToArrayOfEntity($books->getCollection());
        $books->setCollection($collection);
        return $books;
    }

    private function mapCollectionToArrayOfEntity($collection) {
        $mapping = new ArrayMapping($this->getEntityName(), $collection);
        return $mapping->CollectionToArray();
    }

    public function getEntityName()
    {
        $reflector = new \ReflectionClass($this->entity);
        return $reflector->getName();
    }

    public function persist(AbstractEntity $entity)
    {
        $model = $this->model->findOrFail($entity->getId());
        $mapping = new ItemMapping($entity, $model);
        $model = $mapping->EntityToModel();
        $model->save();
        return;
    }

}