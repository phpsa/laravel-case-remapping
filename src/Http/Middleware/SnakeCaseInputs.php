<?php

namespace Phpsa\LaravelCaseRemapping\Http\Middleware;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class SnakeCaseInputs.
 *
 * This middleware makes sure all incoming request parameters are snake cased for the application
 */
class SnakeCaseInputs
{
    /**
     * HTTP Methods we want to consider for transforming URL query params.
     */
    protected const RELEVANT_METHODS = ['POST', 'PATCH', 'PUT', 'DELETE', 'GET'];


    /**
     * Handle an incoming request.
     *
     * Replace all request parameter keys with snake_cased equivilents
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (! in_array($request->method(), self::RELEVANT_METHODS)) {
            return $next($request);
        }

        // Query string parameters
        if ($request->query->count() > 0) {
            $this->processParamBag($request->query);
        }

        // Input parameters
        if ($request->request->count() > 0) {
            $this->processParamBag($request->request);
        }

        //json request
        if ($request->isJson()) {
            $this->processParamBag($request->json());
        }

        return $next($request);
    }

    /**
     * Process parameters within a ParameterBag to snake_case the keys.
     *
     * @param ParameterBag $bag
     */
    protected function processParamBag(ParameterBag $bag)
    {
        $parameters = collect($bag->all());

        if ($parameters->isNotEmpty()) {
            $bag->replace($parameters->snakeKeys(true)->toArray());
        }
    }
}
