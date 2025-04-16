<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateApiActionControllers extends Command
{
    protected $signature = 'generate:api-action-controllers';
    protected $description = 'Generate invokable controllers and requests based on the api_action_controllers config file';

    public function handle()
    {
        $controllers = config('api_action_controllers');
        $apiRoutesPath = base_path('routes/api.php');

        foreach ($controllers as $controllerConfig) {
            $name = $controllerConfig['name'];
            $directory = $controllerConfig['directory'];
            $method = $controllerConfig['method'] ?? 'post';
            $routeName = $controllerConfig['route_name'] ?? '/' . $name;
            $validationRules = $controllerConfig['validation'] ?? []; // Get validation rules
            $namespace = "App\\Http\\Controllers\\$directory";

            // Define paths for the controller and request
            $controllerName = "$name". 'Controller.php';
            $controllerPath = app_path("Http/Controllers/$directory/$controllerName");
            $requestPath = app_path("Http/Requests/{$name}Request.php");

            // Create the directory for the controller if it doesn’t exist
            if (!File::exists(dirname($controllerPath))) {
                File::makeDirectory(dirname($controllerPath), 0755, true);
            }

            // Generate the controller file
            $controllerContent = <<<EOD
            <?php

            namespace $namespace;

            use App\Http\Requests\\{$name}Request;
            use Illuminate\Http\Request;
            use App\Http\Controllers\Controller;

            class {$name}Controller extends Controller
            {
                /**
                 * Handle the incoming request.
                 *
                 * @param  \\App\\Http\\Requests\\{$name}Request  \$request
                 * @return \\Illuminate\\Http\\Response
                 */
                public function __invoke({$name}Request \$request)
                {
                    // Controller logic here
                }
            }
            EOD;

            File::put($controllerPath, $controllerContent);
            $this->info("Generated controller: $name in $directory");

            // Generate the request file if it doesn't exist
            if (!File::exists($requestPath)) {
                // Convert validation rules to JSON, then replace syntax
                $rulesArraySyntax = json_encode($validationRules, JSON_PRETTY_PRINT);
                $rulesArraySyntax = str_replace(['{', '}', ':'], ['[', ']', '=>'], $rulesArraySyntax);

                $requestContent = <<<EOD
                <?php

                namespace App\Http\Requests;

                use Illuminate\Foundation\Http\FormRequest;

                class {$name}Request extends FormRequest
                {
                    /**
                     * Determine if the user is authorized to make this request.
                     *
                     * @return bool
                     */
                    public function authorize()
                    {
                        return true;
                    }

                    /**
                     * Get the validation rules that apply to the request.
                     *
                     * @return array
                     */
                    public function rules()
                    {
                        return $rulesArraySyntax;
                    }
                }
                EOD;

                File::put($requestPath, $requestContent);
                $this->info("Generated request: {$name}Request with validation rules.");
            } else {
                $this->info("Request {$name}Request already exists. Skipping...");
            }

            // Append route to api.php
            $routeContent = <<<EOD

            Route::{$method}('$routeName', \\$namespace\\$name::class);

            EOD;

            File::append($apiRoutesPath, $routeContent);
            $this->info("Appended route for: $name");
        }

        return Command::SUCCESS;
    }
}
