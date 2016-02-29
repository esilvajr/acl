<?php

namespace Acl\Factory;

/**
 * Class Resource
 * @package Acl\Factory
 */
class Resource implements \Acl\Contracts\Factory
{
    /**
     * @var array
     */
    private $resources = [];

    /**
     * @return array
     */
    public function get() : array
    {
        return $this->resources;
    }

    /**
     * @param \Acl\Contracts\Role $resouce
     * @return Resource
     */
    public function add(\Acl\Contracts\Role $resouce) : Resource
    {
        $identifier = $resouce->get();
        if ($this->has($identifier)) {
            throw new \InvalidArgumentException(sprintf(
                'Permission "%s" already exists in the registry',
                $identifier
            ));
        }
        $this->resources[$identifier] = $resouce;
        return $this;

    }

    /**
     * @param $resource
     * @return Resource
     */
    public function remove($resource) : Resource
    {
        try {
            $resource = $this->get($resource)->get();
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
        if (array_key_exists($resource, $this->resources))
            unset($this->resources[$resource]);
        return $this;
    }

    /**
     * @param $resource
     * @return bool
     */
    public function has($resource) : bool
    {
        if ($resource instanceof \Acl\Entity\Resource) {
            $resource = $resource->get();
        } else {
            $resource = (string) $resource;
        }
        return isset($this->resources[$resource]);
    }
}