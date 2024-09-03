<?php

namespace Jatri\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    protected $signature = 'make:crud {name}';
    protected $description = 'Generate CRUD operations';

    public function handle()
    {
        $name = $this->argument('name');

        $this->createModel($name);
        $this->createController($name);
        $this->createValidationFiles($name);
        $this->createMigration($name);
        $this->addRoutes($name);

        $this->info("CRUD operations for $name generated successfully.");
    }

    protected function createModel($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        File::put(app_path("Models/{$name}.php"), $modelTemplate); // Ensure the path matches Laravel's conventions
    }

    protected function createController($name)
    {
        $controllerTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Controller')
        );

        File::put(app_path("Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function createValidationFiles($name)
    {
        $this->createRequest($name, 'Store');
        $this->createRequest($name, 'Update');
    }

    protected function createRequest($name, $type)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub("Request{$type}")
        );

        File::put(app_path("Http/Requests/{$name}{$type}Request.php"), $requestTemplate);
    }

    protected function createMigration($name)
    {
        $tableName = Str::plural(Str::snake($name)); // Use Str::plural and Str::snake for table naming
        $migrationTemplate = str_replace(
            ['{{tableName}}'],
            [$tableName],
            $this->getStub('Migration')
        );

        $timestamp = date('Y_m_d_His');
        File::put(database_path("/migrations/{$timestamp}_create_{$tableName}_table.php"), $migrationTemplate);
    }

    protected function addRoutes($name)
    {
        $routePath = base_path('routes/api.php');
        $routeStub = "Route::apiResource('" . Str::plural(Str::snake($name)) . "', " . "{$name}Controller::class);\n";

        // Check if the route already exists before appending
        if (!Str::contains(File::get($routePath), $routeStub)) {
            File::append($routePath, $routeStub);
        }
    }

    protected function getStub($type)
    {
        return file_get_contents(__DIR__ . "/../stubs/{$type}.stub");
    }
}
