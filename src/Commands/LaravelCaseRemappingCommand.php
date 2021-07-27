<?php

namespace Phpsa\LaravelCaseRemapping\Commands;

use Illuminate\Console\Command;

class LaravelCaseRemappingCommand extends Command
{
    public $signature = 'laravel-case-remapping';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
