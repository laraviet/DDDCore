<?php

namespace Laraviet\DDDCore\Persistence\Cache;

use Laraviet\DDDCore\Domain\Entities\AbstractEntity;
use Laraviet\DDDCore\Domain\Repositories\RepositoryInterface;


abstract class BaseRepository implements RepositoryInterface
{
    protected $repository;
    protected $cache;
    protected $entity_name;

    public function __construct()
    {
        $this->entity_name = $this->repository->getEntityName();
    }

    public function commit()
    {
        $this->repository->commit();
    }

    public function begin()
    {
        $this->repository->begin();
    }

    public function getById($id)
    {
        return $this->cache->tags($this->entity_name)->rememberForever($this->entity_name . '.' . $id, function() use ($id) {
            return $this->repository->getById($id);
        });
    }

    public function getAll()
    {
        return $this->cache->tags($this->entity_name)->rememberForever($this->entity_name . '.all', function(){
            return $this->repository->getAll();
        });
    }

    public function paginate($quantity = null)
    {
        $per_page = isset($quantity) ? $quantity : 10;
        return $this->cache->tags($this->entity_name)->rememberForever($this->entity_name . '.paginate.' . $per_page, function() use ($per_page) {
            return $this->repository->paginate($per_page);
        });
    }

    public function persist(AbstractEntity $entity)
    {
        $this->repository->persist($entity);
        $this->cache->tags($this->entity_name)->flush();
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        $this->cache->tags($this->entity_name)->flush();
    }

}