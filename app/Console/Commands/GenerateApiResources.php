<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateApiResources extends Command
{
    protected $signature = 'generate:api';
    protected $description = 'Generate model, migration, request, controller, resource, and route for API resource';

    public function handle()
    {
        $resources = config('api_resources'); // Load the config file

        foreach ($resources as $resource) {
            $model = $resource['model'];
            $directory = $resource['directory'];
            $columns = $resource['columns'];

            if (empty($columns)) {
                $this->error("No columns defined for {$model}. Skipping...");
                continue;
            }

            $this->generateApiResources($model, $directory, $columns);
        }

        $this->info("API resources generation complete.");
    }

    protected function generateApiResources($model, $directory, $columns)
    {
        // dd($columns);
        $fillableColumns = implode("', '", array_keys($columns));

        // Step 1: Create Model and Migration
        Artisan::call("make:model $model -m");
        $this->info("Model and Migration created for $model.");

        // Step 2: Create Factory for Model
        Artisan::call("make:factory {$model}Factory --model={$model}");
        $this->info("Factory created for $model.");

        // Step 3: Update Migration
        $migrationFile = database_path("migrations/") . now()->format('Y_m_d_His') . "_create_" . Str::snake(Str::plural($model)) . "_table.php";
        file_put_contents($migrationFile, $this->getMigrationContent($model, $columns));
        $this->info("Migration file updated.");

        // Step 4: Create API Resource Controller
        Artisan::call("make:controller {$directory}/{$model}Controller --api --model=$model");
        $this->info("API Controller created.");

        // Step 5: Add Resource Import and CRUD methods to Controller
        $controllerPath = app_path("Http/Controllers/{$directory}/{$model}Controller.php");
        $this->addResourceImportToController($controllerPath, $model, $directory);
        $this->updateControllerWithCrudMethods($controllerPath, $model);
        $this->info("Controller updated with CRUD methods.");

        // Step 6: Create Resource Class
        Artisan::call("make:resource /{$directory}/{$model}Resource");
        $this->info("Resource class created.");

        // Step 7: Create Form Request
        Artisan::call("make:request {$directory}/{$model}Request");
        $this->info("Form Request created.");

        // Add Validation Rules to Request
        $requestPath = app_path("Http/Requests/{$directory}/{$model}Request.php");
        $this->addValidationRulesToRequest($requestPath, $columns);
        $this->info("Validation rules added to request.");

        // Step 8: Add Fillable Fields to Model
        $modelPath = app_path("Models/{$model}.php");
        $this->addFillableToModel($modelPath, $fillableColumns);
        $this->info("Added fillable columns to model.");

        // Step 9: Register API Route
        $this->registerApiRoute($model, $directory);
        $this->info("API route registered.");

        // Step 10: Generate Filter Class with Search
        $filterClassPath = app_path("Filters/{$model}Filter.php");
        $this->createFilterClass($filterClassPath, $model, $columns);
        $this->info("Filter class with search functionality created.");

        // Step 11: Generate Unit Tests
        $this->createUnitTest($model);
        $this->info("Unit test for $model generated successfully!");

        // Step 12: Update Factory with Columns
        $this->updateFactoryWithColumns($model, array_keys($columns));
    }

    protected function parseColumnDefinition($definition)
    {
        // Split by '|' to separate type from constraints
        [$type, $constraints] = array_pad(explode('|', $definition), 2, null);
        $parsedConstraints = $constraints ? explode('|', $constraints) : [];

        return [
            'type' => $type,
            'constraints' => $parsedConstraints,
        ];
    }
    protected function getMigrationContent($model, $columns)
    {
        $columnDefinitions = array_map(function ($column, $config) {
            $type = $config['type'] ?? 'string';
            return "\$table->{$type}('$column');";
        }, array_keys($columns), $columns);

        $columnsAsString = implode("\n            ", $columnDefinitions);

        return <<<EOD
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('{$model}', function (Blueprint \$table) {
                \$table->id();
                $columnsAsString
                \$table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('{$model}');
        }
    };
    EOD;
    }


    protected function addFillableToModel($modelPath, $fillableColumns)
    {
        $modelContent = file_get_contents($modelPath);
        $fillableString = "\n    protected \$fillable = ['$fillableColumns'];\n";
        $modelContent = preg_replace('/\{/', '{' . $fillableString, $modelContent, 1);
        file_put_contents($modelPath, $modelContent);
    }

    protected function addValidationRulesToRequest($requestPath, $columns)
    {
        $rules = array_map(function ($config, $column) {
            $columnRules = isset($config['rules']) ? implode("', '", $config['rules']) : 'required';
            return "'$column' => ['$columnRules']";
        }, $columns, array_keys($columns));

        $rulesAsString = implode(",\n            ", $rules);
        $requestContent = file_get_contents($requestPath);

        $rulesArrayString = <<<EOD
        public function rules(): array
        {
            return [
                $rulesAsString
            ];
        }
        EOD;

        $requestContent = preg_replace('/public function rules\(\): array\s+\{[^}]*\}/', $rulesArrayString, $requestContent);
        file_put_contents($requestPath, $requestContent);
    }

    protected function addResourceImportToController($controllerPath, $model, $directory)
    {
        $controllerContent = file_get_contents($controllerPath);
        $resourceImport = "use App\Http\Resources\\{$directory}\\{$model}Resource;\nuse App\Filters\\{$model}Filter;\nuse App\Http\Requests\\{$directory}\\{$model}Request;\n";

        $controllerContent = preg_replace('/^<\?php\s+namespace[^;]+;/', "$0\n$resourceImport", $controllerContent);
        file_put_contents($controllerPath, $controllerContent);
    }

    // Inside GenerateApiResources.php
    protected function updateControllerWithCrudMethods($controllerPath, $model)
    {
        // Load the controller content
        $controllerContent = file_get_contents($controllerPath);

        // Remove existing placeholder methods and comments if they exist
        $controllerContent = $this->removePlaceholderMethodsAndComments($controllerContent);

        // Add updated CRUD methods with the generated code
        $crudMethods = <<<EOD

    public function index(Request \$request)
    {
        \$query = {$model}::query();
        \$query = (new {$model}Filter(\$request))->apply(\$query);
        return {$model}Resource::collection(\$query->paginate());
    }

    public function store({$model}Request \$request)
    {
        \$item = {$model}::create(\$request->validated());
        return new {$model}Resource(\$item);
    }

    public function show({$model} \$item)
    {
        return new {$model}Resource(\$item);
    }

    public function update({$model}Request \$request, {$model} \$item)
    {
        \$item->update(\$request->validated());
        return new {$model}Resource(\$item);
    }

    public function destroy({$model} \$item)
    {
        \$item->delete();
        return response()->noContent();
    }

EOD;

        // Append the CRUD methods to the controller file
        $controllerContent = preg_replace('/\}$/', $crudMethods . "\n}", $controllerContent);
        file_put_contents($controllerPath, $controllerContent);

        $this->info("CRUD methods updated in {$model}Controller.");
    }

    protected function removePlaceholderMethodsAndComments($controllerContent)
    {
        // Define a regex pattern to match and remove placeholder CRUD methods and comments
        $pattern = '/\/\*\*\s+\*\s+(Display a listing|Store a newly|Display the specified|Update the specified|Remove the specified)[^*]*\*\/\s+public function (index|store|show|update|destroy)\([^\}]*\}(\n\s*)?/m';

        // Remove placeholder methods and their comments
        return preg_replace($pattern, '', $controllerContent);
    }



    protected function registerApiRoute($model, $directory)
    {
        $pluralModel = Str::plural(Str::kebab($model));
        $routeString = "\nRoute::apiResource('$pluralModel', App\Http\Controllers\\{$directory}\\{$model}Controller::class);\n";
        file_put_contents(base_path('routes/api.php'), $routeString, FILE_APPEND);
    }

    protected function createFilterClass($filterClassPath, $model, $columns)
    {
        $columnFilters = '';
        foreach ($columns as $column => $definition) {
            $type = is_array($definition) ? $definition['type'] : $definition;
            $methodName = ucfirst(Str::camel((string) $column));  // Ensure $column is a string

            $columnFilters .= <<<EOD

    protected function filterBy$methodName(\$value)
    {
        \$this->builder->where('$column', \$value);
    }
    EOD;
        }

        $searchableColumns = implode("', '", array_keys($columns)); // Use array_keys to get column names

        $filterClassContent = <<<EOD
    <?php

    namespace App\Filters;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Str;

    class {$model}Filter
    {
        protected \$request;
        protected \$builder;

        public function __construct(\$request)
        {
            \$this->request = \$request;
        }

        public function apply(Builder \$builder)
        {
            \$this->builder = \$builder;

            foreach (\$this->request->all() as \$filter => \$value) {
                \$method = 'filterBy' . ucfirst(Str::camel(\$filter));

                if (method_exists(\$this, \$method)) {
                    \$this->\$method(\$value);
                }
            }

            return \$this->builder;
        }

        protected function filterBySearch(\$value)
        {
            \$searchableColumns = ['$searchableColumns'];

            \$this->builder->where(function (\$query) use (\$searchableColumns, \$value) {
                foreach (\$searchableColumns as \$column) {
                    \$query->orWhere(\$column, 'LIKE', "%{\$value}%");
                }
            });
        }

        $columnFilters
    }
    EOD;

        file_put_contents($filterClassPath, $filterClassContent);
    }


    // Inside GenerateApiResources.php

    protected function createUnitTest($model)
    {
        $testClassPath = base_path("tests/Feature/{$model}ControllerTest.php");

        $pluralModelKebab = Str::kebab(Str::plural($model));

        $testClassContent = <<<EOD
    <?php

    namespace Tests\Feature;

    use App\Models\\{$model};
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class {$model}ControllerTest extends TestCase
    {
        use RefreshDatabase;

        /**
         * Test index method.
         */
        public function test_index()
        {
            {$model}::factory()->count(3)->create();
            
            \$response = \$this->getJson('/api/{$pluralModelKebab}');
            
            \$response->assertStatus(200);
            \$response->assertJsonCount(3, 'data');
        }

        /**
         * Test store method.
         */
        public function test_store()
        {
            \$data = {$model}::factory()->make()->toArray();
            
            \$response = \$this->postJson('/api/{$pluralModelKebab}', \$data);
            
            \$response->assertStatus(201);
            \$this->assertDatabaseHas('{$pluralModelKebab}', \$data);
        }

        /**
         * Test show method.
         */
        public function test_show()
        {
            \$item = {$model}::factory()->create();
            
            \$response = \$this->getJson('/api/{$pluralModelKebab}/' . \$item->id);
            
            \$response->assertStatus(200);
            \$response->assertJson([
                'data' => ['id' => \$item->id]
            ]);
        }

        /**
         * Test update method.
         */
        public function test_update()
        {
            \$item = {$model}::factory()->create();
            \$updateData = {$model}::factory()->make()->toArray();
            
            \$response = \$this->putJson('/api/{$pluralModelKebab}/' . \$item->id, \$updateData);
            
            \$response->assertStatus(200);
            \$this->assertDatabaseHas('{$pluralModelKebab}', \$updateData);
        }

        /**
         * Test destroy method.
         */
        public function test_destroy()
        {
            \$item = {$model}::factory()->create();
            
            \$response = \$this->deleteJson('/api/{$pluralModelKebab}/' . \$item->id);
            
            \$response->assertStatus(204);
            \$this->assertDatabaseMissing('{$pluralModelKebab}', ['id' => \$item->id]);
        }
    }
    EOD;

        // Create the test file and write content to it
        file_put_contents($testClassPath, $testClassContent);
        $this->info("Unit test created for {$model}Controller.");
    }

    protected function updateFactoryWithColumns($model, $columns)
    {
        $factoryPath = database_path("factories/{$model}Factory.php");

        $factoryContent = file_get_contents($factoryPath);

        // Define the factory attributes
        $attributes = '';

        foreach ($columns as $key => $column) {
            $attributes .= "            '{$column}' => \$this->faker->word(),\n";
        }

        // Insert attributes into factory definition
        $factoryContent = preg_replace(
            '/return\s+\[([^\]]*)\];/s',
            "return [\n$attributes        ];",
            $factoryContent
        );

        file_put_contents($factoryPath, $factoryContent);

        $this->info("Factory for {$model} updated with columns.");
    }
}
