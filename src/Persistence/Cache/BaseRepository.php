<?php

namespace Laraviet\DDDCore\Persistence\Cache;

use Laraviet\DDDCore\Domain\Entities\AbstractEntity;
use Laraviet\DDDCore\Domain\Repositories\RepositoryInterface;


abstract class BaseRepository implements RepositoryInterface
{
    protected $repository;
    protected $cache;
    protected $identity;

    public function __construct()
    {
        $this->identity = $this->repository->identity();
    }

    public function begin()
    {
        $this->repository->begin();
    }

    public function commit()
    {
        $this->repository->commit();
    }

    public function getAll()
    {
        $query_string = $this->queryString();
        return $this->cache->tags($this->identity)->rememberForever($this->identity . '.all.' . $query_string, function(){
            return $this->repository->getAll();
        });
    }

    public function getById($id)
    {
        return $this->cache->tags($this->identity)->rememberForever($this->identity . '.detail.' . $id, function() use ($id) {
            return $this->repository->getById($id);
        });
    }

    public function paginate($quantity = null)
    {
        $query_string = $this->queryString();
        return $this->cache->tags($this->identity)->rememberForever($this->identity . '.paginate.' . $query_string, function() use ($quantity) {
            return $this->repository->paginate($quantity);
        });
    }

    public function persist($model)
    {
        $this->repository->persist($model);
        $this->cache->tags($this->identity)->flush();
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        $this->cache->tags($this->identity)->flush();
    }

    /**
     * Get query string helper function
     */
    private function queryString()
    {
        return $_SERVER['QUERY_STRING'] ?: "no_query_string";
    }

}