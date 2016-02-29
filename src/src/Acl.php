<?php
declare(strict_types=1);

namespace Acl;

use Traversable;

class Acl
{
    protected $roles = [];
    protected $resources;
    protected $incident;
    private $user;

    public function __construct(\Acl\Contracts\Factory $factory)
    {;
        $roles = new \ArrayObject($factory->all());
        if ($roles instanceof Traversable) {
            foreach($roles as $role) {
                $this->roles[$role->get()] = $role;
            }
            $this->roles = new \ArrayObject($this->roles);
        }
    }


    public function user(\Acl\Contracts\User $user): Acl
    {
        $this->user = $user;
        return $this;
    }

    public function hasRole(string $find): bool
    {
        if ($this->roles->offsetExists($find)) {
                return true;
        }
        return false;
    }

    public function hasResource(string $role, string $resource): bool
    {
        if ($this->hasRole($role)) {
            $resources = new \ArrayObject($this->roles->offsetGet($role)->resources()->get());
            if ($resources->offsetExists($resource)) {
                return true;
            }
        }
        return false;
    }

    public function can(string $resource): bool
    {
        if (!isset($this->user))
            throw new \InvalidArgumentException(\Acl\i18n\Translate::ACL_EMPTY_USER[LANG]);

        return $this->hasPermission($this->user->role()->get(), $resource);
    }

    /**
     * @param string $permission
     * @param UserAcl|null $user
     * @return bool
     */
    public function cannot(string $resource): bool
    {
        return !$this->can($resource);
    }

    public function owns(\Acl\Contracts\Incident $incident, \Acl\Contracts\User $user): bool
    {
        if ($incident->owner() == $user)
            return true;
        return false;
    }
}