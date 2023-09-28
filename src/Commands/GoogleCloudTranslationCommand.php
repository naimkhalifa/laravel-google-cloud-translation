<?php

namespace NaimKhalifa\GoogleCloudTranslation\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use NaimKhalifa\GoogleCloudTranslation\Facades\GoogleCloudTranslation;

class GoogleCloudTranslationCommand extends Command
{
    public $signature = 'google-cloud-translation:translate-strings {--source=} {--target=} {--file=} {--dryrun=true}';

    public $description = 'Translates all strings in a lang file.';

    private string $source;

    private string $target;

    private string $file;

    private bool $dryrun;

    private string $newFilePath;

    /**
     * @var array<string, string>
     */
    private array $translated = [];

    public function handle(): int
    {
        $this->source = is_string($this->option('source')) ? $this->option('source') : '';
        $this->target = is_string($this->option('target')) ? $this->option('target') : '';
        $this->file = is_string($this->option('file')) ? $this->option('file') : '';
        $this->dryrun = $this->option('dryrun') === 'true' ? true : false;

        if (! $this->validateOptions()) {
            return self::FAILURE;
        }

        $this->info('Translating strings in '.$this->file.' from '.$this->source.' to '.$this->target.'...');

        $this->translateStrings();

        $this->info('Writing translations to file...');

        $this->writeFile();

        if ($this->dryrun) {
            $this->outputTranslations();
            $confirmed = $this->confirm(
                'Dryrun mode enabled. Do you want to write the translations to '.str_replace('.tmp', '', $this->newFilePath).'?'
            );

            if (! $confirmed) {
                $this->info('Aborting...');

                // delete temp file
                unlink($this->newFilePath);

                return self::SUCCESS;
            }

            $this->info('Writing translations to '.$this->newFilePath.'...');

            rename($this->newFilePath, str_replace('.tmp', '', $this->newFilePath));
        }

        $this->info('Done!');

        return self::SUCCESS;
    }

    protected function validateOptions(): bool
    {
        if (! $this->source) {
            $this->error('The "--source" option must be set.');

            return false;
        }

        if (! $this->target) {
            $this->error('The "--target" option must be set.');

            return false;
        }

        if (! $this->file) {
            $this->error('The "--file" option must be set.');

            return false;
        }

        if (! file_exists($this->file)) {
            $this->error('File '.$this->file.' does not exist.');

            return false;
        }

        if (! in_array($this->source, GoogleCloudTranslation::supportedLanguages())) {
            $this->error('Invalid source language.');

            return false;
        }

        if (! in_array($this->target, GoogleCloudTranslation::supportedLanguages())) {
            $this->error('Invalid target language.');

            return false;
        }

        if ($this->source === $this->target) {
            $this->error('Source and target languages cannot be the same.');

            return false;
        }

        return true;
    }

    protected function translateStrings(): void
    {
        $translationStrings = require $this->file;

        foreach ($translationStrings as $key => $value) {
            if (! is_string($key)) {
                continue;
            }

            $this->translated[$key] = $this->translate($value);
        }
    }

    protected function translate(string $value): string
    {
        return GoogleCloudTranslation::translate($value, [
            'source' => $this->source,
            'target' => $this->target,
            'format' => 'text',
        ]);
    }

    protected function writeFile(): void
    {
        $newFileContent = $this->setNewFileContent();

        if ($this->dryrun) {
            $this->info('Dryrun mode enabled. Writing to temp file...');
            $this->newFilePath = str_replace($this->source, $this->target, $this->file).'.tmp';
            file_put_contents($this->newFilePath, $newFileContent);

            return;
        }

        // write new content to file at same directory level but with target language
        $this->newFilePath = str_replace($this->source, $this->target, $this->file);
        file_put_contents($this->newFilePath, $newFileContent);
    }

    protected function setNewFileContent(): string
    {
        $content = "<?php\n\nreturn [\n\n";

        foreach ($this->translated as $key => $value) {
            $content .= "  \"$key\" => \"$value\",\n";
        }

        $content .= "\n];\n";

        return $content;
    }

    protected function outputTranslations(): void
    {
        $mappedTranslations = Arr::map($this->translated, function ($value, $key) {
            return [$key, $value];
        });

        $this->table(['Key', 'Value'], $mappedTranslations);
    }
}
