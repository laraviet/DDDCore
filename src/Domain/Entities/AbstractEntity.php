<?php

namespace Laraviet\DDDCore\Domain\Entities;

abstract class AbstractEntity
{
    protected $id;

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getAllProperties()
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        $probs_array = [];
        foreach ($props as $prop) {
            $probs_array[] =  $prop->getName();
        }
        return $probs_array;
    }
}