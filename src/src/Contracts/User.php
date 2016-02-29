<?php

namespace Acl\Contracts;

/**
 * Interface User
 * @package Acl\Contracts
 */
interface User
{
    /**
     * @param Role $role
     * @return Role
     */
    public function role(\Acl\Contracts\Role  $role ) : \Acl\Contracts\Role ;
}