<?php

namespace NaimKhalifa\GoogleCloudTranslation\Commands;

use Illuminate\Console\Command;

class GoogleCloudTranslationCommand extends Command
{
    public $signature = 'laravel-google-cloud-translation';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
