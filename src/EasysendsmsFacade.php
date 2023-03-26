<?php

namespace Hmimeee\Easysendsms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hmimeee\Easysendsms\Skeleton\SkeletonClass
 */
class EasysendsmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'easysendsms';
    }
}
