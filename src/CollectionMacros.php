<?php

namespace Phpsa\LaravelCaseRemapping;

use Illuminate\Support\Str;

/** @mixin \Illuminate\Support\Collection */
class CollectionMacros
{
    public function snakeKeys()
    {
        return function ($tidy = true) {
            // @var \Illuminate\Support\Collection $this
            $result = [];

            foreach ($this->all() as $key => $value) {
                $newKey = Str::snake($key);
                if ($tidy) {
                    $newKey = Str::replace('-', '_', $newKey);
                    $newKey = preg_replace('/__+/', '_', $newKey);
                }
                $result[$newKey] = is_array($value) ? collect($value)->snakeKeys($tidy)->toArray() : $value;
            }

            // @phpstan-ignore-next-line
            return new static($result);
        };
    }

    public function camelKeys()
    {
        return function () {
            // @var \Illuminate\Support\Collection $this
            $result = [];

            foreach ($this->all() as $key => $value) {
                $newKey = Str::camel($key);
                $result[$newKey] = is_array($value) ? collect($value)->camelKeys()->toArray() : $value;
            }

            // @phpstan-ignore-next-line
            return new static($result);
        };
    }

    public function kebabKeys()
    {
        return function ($tidy = true) {
            // @var \Illuminate\Support\Collection $this
            $result = [];

            foreach ($this->all() as $key => $value) {
                $newKey = Str::kebab($key);
                if ($tidy) {
                    $newKey = Str::replace('_', '-', $newKey);
                    $newKey = preg_replace('/--+/', '-', $newKey);
                }
                $result[$newKey] = is_array($value) ? collect($value)->kebabKeys($tidy)->toArray() : $value;
            }

            // @phpstan-ignore-next-line
            return new static($result);
        };
    }
}
