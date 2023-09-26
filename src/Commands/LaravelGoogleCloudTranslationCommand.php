<?php

namespace NaimKhalifa\LaravelGoogleCloudTranslation\Commands;

use Illuminate\Console\Command;

class LaravelGoogleCloudTranslationCommand extends Command
{
    public $signature = 'laravel-google-cloud-translation';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
