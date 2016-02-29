<?php

namespace Acl\Factory;

/**
 * Class Role
 * @package Acl\Factory
 */
class Role implements \Acl\Contracts\Factory
{

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @return array
     */
    public function all()
    {
        return $this->roles;
    }

    /**
     * @param $role
     * @return mixed
     */
    public function get($role)
    {
        return $this->roles[$role];
    }

    /**
     * @param \Acl\Contracts\Role $role
     * @return \Acl\Contracts\Role
     */
    public function add(\Acl\Contracts\Role $role) : \Acl\Contracts\Role
    {
        $identifier = $role->get();
        if ($this->has($identifier)) {
            throw new \InvalidArgumentException(
                sprintf(
                    \Acl\i18n\Translate::ROLE_ALREADY_EXISTS[LANG],
                    $identifier
                )
            );
        }
        $this->roles[$identifier] = $role;
        return $role;
    }

    /**
     * @param $role
     * @return Role
     */
    public function remove($role) : Role
    {
        try {
            $role = $this->get($role)->get();
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
        if (array_key_exists($role, $this->roles))
            unset($this->roles[$role]);
        return $this;
    }

    /**
     * @param $role
     * @return bool
     */
    public function has($role) : bool
    {
        if ($role instanceof \Acl\Contracts\Factory) {
            $role = $role->get();
        } else {
            $role = (string) $role;
        }
        return isset($this->roles[$role]);
    }

    /**
     * @param $role
     * @return mixed
     */
    public function resources($role)
    {
        $this->roles[$role]->resources(new \Acl\Factory\Resource());
        return $this->roles[$role]->resources();
    }
}