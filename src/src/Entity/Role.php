<?php
declare(strict_types=1);

namespace Acl\Entity;

/**
 * Class Role
 * @package Acl\Entity
 */
class Role implements \Acl\Contracts\Role
{

    /**
     * @var string
     */
    protected $identifier;
    /**
     * @var
     */
    protected $resource;

    /**
     * Role constructor.
     * @param string|null $identifier
     */
    public function __construct(string $identifier = null)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return Role
     */
    public function set(string $identifier): Role
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @param \Acl\Factory\Resource|null $resource
     * @return mixed
     */
    public function resources(\Acl\Factory\Resource $resource = null)
    {;
        if (is_null($resource))
            return $this->resource;

        $this->resource = $resource;
    }

}