<?php
declare(strict_types=1);

namespace Acl\Entity;

/**
 * Class Resource
 * @package Acl\Entity
 */
class Resource implements \Acl\Contracts\Role
{

    /**
     * @var string
     */
    protected $identifier;

    /**
     * Resource constructor.
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
     * @return Resource
     */
    public function set(string $identifier): Resource
    {
        $this->identifier = $identifier;
        return $this;
    }

}