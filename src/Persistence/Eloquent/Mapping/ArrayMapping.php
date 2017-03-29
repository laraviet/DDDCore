<?php

namespace Laraviet\DDDCore\Persistence\Eloquent\Mapping;

class ArrayMapping
{
    protected $collection;
    protected $entity_type;

    public function __construct($entity_type, $collection)
    {
        $this->entity_type = $entity_type;
        $this->collection = $collection;
    }

    public function CollectionToArray()
    {
        return $this->collection->map(function($item){
            $mapping = new ItemMapping(new $this->entity_type(), $item);
            return $mapping->ModelToEntity();
        });
    }

}