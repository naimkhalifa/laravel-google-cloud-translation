<?php

// https://www.leonelngande.com/unit-testing-translation-strings-in-laravel/

describe('TranslateLangFile', function () {
    afterEach(function () {
        if (file_exists(__DIR__.'/../static/fr/translations.php')) {
            unlink(__DIR__.'/../static/fr/translations.php');
        }

        if (file_exists(__DIR__.'/../static/fr/translations.php.tmp')) {
            unlink(__DIR__.'/../static/fr/translations.php.tmp');
        }
    });

    it('has a static source file for tests', function () {
        $this->assertFileExists(__DIR__.'/../static/en/translations.php');
    });

    it('exits if --source option is not provided', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --target=fr --file=tests/static/en/translations.php')
            ->assertExitCode(1)
            ->expectsOutput('The "--source" option must be set.');
    });

    it('exits if --target option is not provided', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --source=en --file=tests/static/en/translations.php')
            ->assertExitCode(1)
            ->expectsOutput('The "--target" option must be set.');
    });

    it('exits if --file option is not provided', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --target=fr --source=en')
            ->assertExitCode(1)
            ->expectsOutput('The "--file" option must be set.');
    });

    it('exits if the file is not valid', function () {
        $invalidFile = 'tests/static/en/invalid.php';
        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=fr --file='.$invalidFile)
            ->assertExitCode(1)
            ->expectsOutput("File $invalidFile does not exist.");
    });

    it('exits if provided source locale is not supported', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --source=xx --target=fr --file=tests/static/en/translations.php')
            ->assertExitCode(1)
            ->expectsOutput('Invalid source language.');
    });

    it('exits if provided target locale is not supported', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=xx --file=tests/static/en/translations.php')
            ->assertExitCode(1)
            ->expectsOutput('Invalid target language.');
    });

    it('outputs a file containing all translations for provided language without confirming if --dryrun is set to false', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=fr --file=tests/static/en/translations.php --dryrun=false')
            ->assertExitCode(0);

        $this->assertFileExists(__DIR__.'/../static/fr/translations.php');
    });

    it('outputs the content to the terminal if --dryrun is set to true', function () {
        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=fr --file=tests/static/en/translations.php --dryrun=true')
            ->expectsConfirmation('Dryrun mode enabled. Do you want to write the translations to tests/static/fr/translations.php?', 'no')
            ->expectsTable(
                ['Key', 'Value'],
                [
                    ['hello', 'Une doublure de traduction'],
                    ['world', 'Une doublure de traduction'],
                    ['complete_sentence', 'Une doublure de traduction'],
                ]
            );
    });

    it('asks for confirmation and write the translations to the file if --dryrun is set to true and the user confirms', function () {
        $filePath = 'tests/static/en/translations.php';
        $newFilePath = 'tests/static/fr/translations.php';

        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=fr --file='.$filePath)
            ->expectsConfirmation('Dryrun mode enabled. Do you want to write the translations to '.$newFilePath.'?', 'yes')
            ->assertExitCode(0);

        $this->assertFileExists(__DIR__.'/../static/fr/translations.php');
    });

    it('aborts if --dryrun is set to true and the user does not confirm', function () {
        $filePath = 'tests/static/en/translations.php';
        $newFilePath = 'tests/static/fr/translations.php';

        $this->artisan('google-cloud-translation:translate-lang-file --source=en --target=fr --file='.$filePath)
            ->expectsConfirmation('Dryrun mode enabled. Do you want to write the translations to '.$newFilePath.'?', 'no')
            ->assertExitCode(0);

        $this->assertFileDoesNotExist(__DIR__.'/../static/fr/translations.php');
        $this->assertFileDoesNotExist(__DIR__.'/../static/fr/translations.php.tmp');
    });
});
