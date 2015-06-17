<?php

namespace TK\UserManagerBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class AppFixtures extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/userRoles.yml',
            __DIR__ . '/users.yml',
            __DIR__ . '/userAddresses.yml',
        );
    }
}