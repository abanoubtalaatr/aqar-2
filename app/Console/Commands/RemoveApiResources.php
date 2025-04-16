<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RemoveApiResources extends Command
{
    protected $signature = 'remove:api {name} {--path= : Specify a directory path for files to remove (e.g., Api/Mobile)}';
    protected $description = 'Remove all API resources related to the given name (model, migration, controller, request, resource, factory, tests, and routes)';

    public function handle()
    {
        $name = $this->argument('name');
        $pathOption = trim($this->option('path'), '/');
        $model = Str::studly($name);
        $pluralModel = Str::plural($model);
        $pluralModelKebab = Str::kebab($pluralModel);

        // Define base paths with the path option in the correct position
        $modelPath = app_path("Models/{$model}.php");
        $controllerPath = app_path("Http/Controllers/{$pathOption}/{$model}Controller.php");
        $requestPath = app_path("Http/Requests/{$pathOption}/{$model}Request.php");
        $resourcePath = app_path("Http/Resources/{$pathOption}/{$model}Resource.php");
        $filterPath = app_path("Filters/{$model}Filter.php");

        $factoryPath = database_path("factories/{$model}Factory.php");
        $testPath = base_path("tests/Feature/{$model}ControllerTest.php");

        // Step 1: Delete Model
        $this->deleteFile($modelPath, "Model");

        // Step 2: Delete Migration
        $migrations = File::glob(database_path("migrations/*_create_" . Str::snake($pluralModel) . "_table.php"));
        foreach ($migrations as $migration) {
            $this->deleteFile($migration, "Migration");
        }

        // Step 3: Delete Factory
        $this->deleteFile($factoryPath, "Factory");

        // Step 4: Delete Controller
        $this->deleteFile($controllerPath, "Controller");

        // Step 5: Delete Request

        $this->deleteFile($requestPath, "Request");

        // Step 6: Delete Resource
        $this->deleteFile($resourcePath, "Resource");

        // Step 7: Delete Filter Class
        $this->deleteFile($filterPath, "Filter");

        // Step 8: Delete Unit Test
        $this->deleteFile($testPath, "Test");

        // Step 9: Remove API Route
        $apiRouteFile = base_path('routes/api.php');
        $routePattern = "/Route::apiResource\\('$pluralModelKebab', [^;]*?\\);\\n/";
        $apiRoutesContent = file_get_contents($apiRouteFile);
        $updatedContent = preg_replace($routePattern, '', $apiRoutesContent);
        if ($updatedContent !== $apiRoutesContent) {
            file_put_contents($apiRouteFile, $updatedContent);
            $this->info("API route for $model removed from api.php.");
        } else {
            $this->warn("API route for $model not found in api.php.");
        }

        $this->info("All resources related to {$model} have been removed.");
    }

    protected function deleteFile($path, $type)
    {
        if (File::exists($path)) {
            File::delete($path);
            $this->info("$type deleted successfully at $path.");
        } else {
            $this->warn("$type not found at $path.");
        }
    }
}
