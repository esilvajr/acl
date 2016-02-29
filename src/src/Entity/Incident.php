<?php
declare(strict_types=1);

namespace Acl\Entity;

/**
 * Class Incident
 * @package Acl\Entity
 */
class Incident implements \Acl\Contracts\Role, \Acl\Contracts\Incident
{

    /**
     * @var string
     */
    protected $identifier;
    /**
     * @var
     */
    protected $owner;

    /**
     * Incident constructor.
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

    /**
     * @param \Acl\Contracts\User|null $owner
     * @return \Acl\Contracts\User
     */
    public function owner(\Acl\Contracts\User $owner = null) : \Acl\Contracts\User
    {
        if (!is_null($owner))
            $this->owner = $owner;

        return $this->owner;
    }

}