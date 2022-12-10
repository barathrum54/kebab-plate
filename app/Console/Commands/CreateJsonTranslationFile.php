<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateJsonTranslationFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:generate-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands go through lang files and creates *.json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $storage = Storage::disk('languages');
        $directories = $storage->directories();
        foreach ($directories as $directory) {
            $files = $storage->allFiles($directory);
            $array = [];
            foreach ($files as $file) {
                if (str_starts_with($file, $directory . '/api')) {
                    continue;
                }
                $baseName = str_replace('.php', '', basename($file));
                $contents = require $storage->path($file);
                $array[$baseName] = $contents;
            }

            $filePath = sprintf('%s.json', $directory);
            $storage->put($filePath, json_encode($array, JSON_PRETTY_PRINT));
        }

        $this->info('Files generated');

        return 0;
    }
}
