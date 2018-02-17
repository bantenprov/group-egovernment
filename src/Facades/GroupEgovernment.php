<?php

namespace Bantenprov\GroupEgovernment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The GroupEgovernment facade.
 *
 * @package Bantenprov\GroupEgovernment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class GroupEgovernment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'group-egovernment';
    }
}
