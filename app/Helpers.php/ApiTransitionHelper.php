<?php

namespace App\Helpers;


class ApiTransitionHelper
{
    public static function isServiceTransitioned(string $serviceName): bool
    {
        $transitionedAPi = config("TransitionEndpoints.transitionedApi");
        return in_array($serviceName, $transitionedAPi);
    }
}
