<?php

namespace Acl\Contracts;

/**
 * Interface Role
 * @package Acl\Contracts
 */
interface Role
{
    /**
     * @return string
     */
    public function get() : string;
}