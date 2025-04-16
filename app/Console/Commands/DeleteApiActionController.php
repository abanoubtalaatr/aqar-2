<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteApiActionController extends Command
{
    protected $signature = 'delete:api-action-controller {name} {directory=Api}';
    protected $description = 'Delete an invokable controller, request, and route from the api.php file based on the given controller name';

    public function handle()
    {
        $name = $this->argument('name');
        $directory = $this->argument('directory');
        $controllerName = "{$name}Controller.php";
        $controllerPath = app_path("Http/Controllers/{$directory}/{$controllerName}");
        $requestPath = app_path("Http/Requests/{$name}Request.php");
        $apiRoutesPath = base_path('routes/api.php');
        $namespace = "App\\Http\\Controllers\\{$directory}";

        // 1. Delete the controller file if it exists
        if (File::exists($controllerPath)) {
            File::delete($controllerPath);
            $this->info("Deleted controller: $controllerPath");
        } else {
            $this->warn("Controller $controllerPath does not exist.");
        }

        // 2. Delete the request file if it exists
        if (File::exists($requestPath)) {
            File::delete($requestPath);
            $this->info("Deleted request: $requestPath");
        } else {
            $this->warn("Request $requestPath does not exist.");
        }

        // 3. Remove the route from api.php
        if (File::exists($apiRoutesPath)) {
            $routePattern = "/Route::post\('\/{$name}-publish',\\s*\\\\App\\\\Http\\\\Controllers\\\\Api\\\\{$name}::class\);/";
            $apiRoutesContent = File::get($apiRoutesPath);

            // Check if the route pattern exists and remove it
            if (preg_match($routePattern, $apiRoutesContent)) {
                $updatedRoutesContent = preg_replace($routePattern, '', $apiRoutesContent);
                File::put($apiRoutesPath, $updatedRoutesContent);
                $this->info("Deleted route for: /{$name}-publish in api.php");
            } else {
                $this->warn("Route for /{$name}-publish not found in api.php.");
            }
        } else {
            $this->warn("api.php file not found.");
        }

        return Command::SUCCESS;
    }
}
