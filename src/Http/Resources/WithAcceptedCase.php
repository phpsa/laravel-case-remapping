<?php

namespace Phpsa\LaravelCaseRemapping\Http\Resources;

use Illuminate\Support\Str;

trait WithAcceptedCase
{
    protected function toAcceptCase($request, $data)
    {
        return match (Str::lower($request->header('X-Accept-Case-Type'))) {
            'camel','camel-case' => collect($data)->snakeKeys(true)->toArray(),
            'snake','snake-case' => collect($data)->camelKeys(true)->toArray(),
            'kebab', 'kebab-case' => collect($data)->kebabKeys(true)->toArray(),
            default => $data
        };
    }
}
