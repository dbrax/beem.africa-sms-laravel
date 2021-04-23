<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/beem.africa-sms-laravel
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BongolivesmsLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\BongolivesmsLaravel\Skeleton\SkeletonClass
 */
class BongolivesmsLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bongolivesms-laravel';
    }
}
