<?php

namespace Acl\Contracts;

/**
 * Interface Factory
 * @package Acl\Contracts
 */
interface Factory
{
    /**
     * @param Role $item
     * @return mixed
     */
    public function add(\Acl\Contracts\Role $item);

    /**
     * @param $item
     * @return mixed
     */
    public function remove($item);

    /**
     * @param $item
     * @return bool
     */
    public function has($item) : bool;
}