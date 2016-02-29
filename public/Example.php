<?php

/*
 * -------------------------------------------------------------------------------
 * Composer autoloader
 * -------------------------------------------------------------------------------
 */
require_once "../vendor/autoload.php";

/*
 * -------------------------------------------------------------------------------
 * Some basic config
 * -------------------------------------------------------------------------------
 */

/*
 * Defines a default language for this ACL erros,
 * you can edit the constants in \Acl\i18n\Translate
 */
define('LANG', 'pt-BR');

/*
 * Define role list.
 */
define('OWNER', "owner");
define('ADMIN', "administrator");
define('USER', "user");

/*
 * Define list of resources
 */
define('ALL', "all_permissions_granted");
define('CONTRIBUTOR', 'contributor_permissions_granted');
define('WEBSERVICE', 'webservice_permissions_granted');
define('EDITOR', 'edit_permissions_granted');

/*
 *
 * -------------------------------------------------------------------------------
 * Create base classes with are instances of \Acl\Contracts\User
 * all classes implements the method role.
 * Sample 1: Represents a 'Owner' user,
 * Sample 2: Represents a 'Administrator' user;
 * Sample 3: Represents a 'User' user;
 * --------------------------------------------------------------------------------
 */

/**
 * Owner class
 * @implements \Acl\Contracts\User
 */
class Owner implements \Acl\Contracts\User
{
    private $role;

    public function __construct(\Acl\Contracts\Role $role = null)
    {
        $this->role($role);
    }

    public function role(\Acl\Contracts\Role $role = null) : \Acl\Contracts\Role
    {
        if (!is_null($role))
            $this->role = $role;
        return $this->role;
    }
}

/**
 * Administrator class
 * @implements \Acl\Contracts\User
 */
class Administrator implements \Acl\Contracts\User
{
    private $role;

    public function __construct(\Acl\Contracts\Role $role = null)
    {
        $this->role($role);
    }

    public function role(\Acl\Contracts\Role $role = null) : \Acl\Contracts\Role
    {
        if (!is_null($role))
            $this->role = $role;
        return $this->role;
    }
}

/**
 * User class
 * @implements \Acl\Contracts\User
 */
class Users implements \Acl\Contracts\User
{
    private $role;

    public function __construct(\Acl\Contracts\Role $role = null)
    {
        $this->role($role);
    }

    public function role(\Acl\Contracts\Role $role = null) : \Acl\Contracts\Role
    {
        if (!is_null($role))
            $this->role = $role;
        return $this->role;
    }
}

/*
 * -------------------------------------------------------------------------------
 * Creating new FACTORIES
 * -------------------------------------------------------------------------------
 * The factories are used to create and configure a Role or a Resource
 */

/*
 * -------------------------------------------------------------------------------
 * Sample 1 - Full straight way
 * Create a new \Acl\Factory\Role()y() object,
 * after that call resouces passing by a instance of \Acl\Entity\Role()
 * and finally call add to set one or many \Acl\Entity\Resouce()
 * -------------------------------------------------------------------------------
 */

//Create new \Acl\Source\Models\Role\Factory() Object
$roleFactory = new \Acl\Factory\Role();

//Call permissions passing by a instance of \Acl\Source\Entity\Role() to add permissions.
$roleFactory->resources($roleFactory->add(new \Acl\Entity\Role(OWNER))->get())
            ->add(new \Acl\Entity\Resource('ALL'))
            ->add(new \Acl\Entity\Resource('ALL_GRANTED'))
            ->add(new \Acl\Entity\Resource('ALL_VIEW'));

/*
 * ------------------------------------------------------------------------------
 * Sample 2 - By step way
 * Create a new \Acl\Factory\Role() object
 * after that add all roles for this factory
 * after that call resouces passing a role by param
 * and finally call add to set one or many \Acl\Entity\Resouce() that
 * belongs to an role
 * @todo We need to set up permissions for all roles individually
 * ------------------------------------------------------------------------------
 */

//Create new \Acl\Factory\Role() Object
$roleFactory = new \Acl\Factory\Role();

//Add a new \Acl\Entity\Role() of OWNER type;
$owner = $roleFactory->add(new \Acl\Entity\Role(OWNER));
//Add a new \Acl\Entity\Role() of ADMIN type;
$admin = $roleFactory->add(new \Acl\Entity\Role(ADMIN));
//Add a new \Acl\Entity\Role() of USER type;
$users = $roleFactory->add(new \Acl\Entity\Role(USER));

//Add resources that belongs to "Owner" role
$roleFactory->resources($owner->get())->add(new \Acl\Entity\Resource(ALL));

//Add resources that belongs to "Admin" role
$roleFactory->resources($admin->get())
            ->add(new \Acl\Entity\Resource(EDITOR))
            ->add(new \Acl\Entity\Resource(WEBSERVICE));

//Add resouces that belongs to "Users" role
$roleFactory->resources($users->get())->add(new \Acl\Entity\Resource(CONTRIBUTOR));

/*
 * ------------------------------------------------------------------------------
 * Creating users of type:
 * Owner::class,
 * Administator::class
 * and Users::class.
 * Passing a role by param.
 * -----------------------------------------------------------------------------
 */

$owner = new Owner($roleFactory->get(OWNER));
$administrator = new Administrator($roleFactory->get(ADMIN));
$users = new Users($roleFactory->get(OWNER));

/*
 * ------------------------------------------------------------------------------
 * Create a new \Acl\Source\Acl() object,
 * This constructor set up a new FactoryInterface object
 * ------------------------------------------------------------------------------
 */
$acl = new \Acl\Acl($roleFactory);


/*
 * ------------------------------------------------------------------------------
 * Sample 1 - Setting  a user for acl
 * as we need a user we can set like in example 1 or direcly
 * ------------------------------------------------------------------------------
 */
$acl->user($owner); //or $acl->user($owner)->method();
/*
 * ------------------------------------------------------------------------------
 * Sample 2 - Has role?
 * ------------------------------------------------------------------------------
 */
$acl->user($owner)->hasRole('owner'); //or $acl->hasRole('ALL') if user already set

/*
 * ------------------------------------------------------------------------------
 * Sample 3 - Has resource?
 * ------------------------------------------------------------------------------
 */
$acl->user($owner)->hasResource($roleFactory->get(OWNER)->get(), 'ALL');

/*
 * ------------------------------------------------------------------------------
 * Sample 4 - Can and Cannot
 * ------------------------------------------------------------------------------
 */
$acl->user($owner)->can(ALL);
$acl->user($owner)->cannot(ALL);

/*
 * ------------------------------------------------------------------------------
 * Sample 4 - Have a Incident
 * ------------------------------------------------------------------------------
 */
//Set new incident
$incident = new \Acl\Entity\Incident('Coke');
$incident->owner($owner);
//Verify if owns
$acl->owns($incident, $owner);
