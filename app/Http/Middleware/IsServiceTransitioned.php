<?php

namespace App\Http\Middleware;

use App\Helpers\ApiTransitionHelper;
use Closure;
use Illuminate\Http\Request;

class IsServiceTransitioned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
            This section will check whether the api is in the new service
            if not we redirect the request to the old module
            if the api has been transitioned we will proceed with the request on the new service
         */

        $request_route_name = array_key_exists("as", $request->route()->action) ?   $request->route()->action['as'] : "";

        $transitionedAPi = config("TransitionEndpoints.transitionedApi");
        $isApiTransitioned = in_array($request_route_name, $transitionedAPi);

        if (!$isApiTransitioned) {
            return response()->json("This request has not been transitioned to the new service. So, it will be routed through the old service", 200);
        }

        return $next($request);
    }
}
