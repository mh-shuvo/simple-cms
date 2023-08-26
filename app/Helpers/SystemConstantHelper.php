<?php

namespace App\Helpers;

class SystemConstantHelper
{
    private function __construct(){}
    const LOCAL_ENV = 'local';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUSES = [self::STATUS_ACTIVE,self::STATUS_INACTIVE];
}
