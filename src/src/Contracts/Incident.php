<?php

namespace Acl\Contracts;

/**
 * Interface Incident
 * @package Acl\Contracts
 */
interface Incident
{
    /**
     * @param User $owner
     * @return User
     */
    public function owner(User $owner) : User;
}