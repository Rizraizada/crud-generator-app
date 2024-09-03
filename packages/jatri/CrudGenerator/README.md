# Jatri CRUD Generator

## Description

The Jatri CRUD Generator is a Laravel package that helps you quickly generate CRUD operations for your models. It streamlines the process of creating controllers, models, validation files, migration files, and API routes, making it easier to get your application up and running.

## Features

- **Generate Controller**: Automatically creates a controller with basic CRUD operations.
- **Generate Model**: Creates a model with fillable fields.
- **Generate Validation Files**: Creates store and update validation requests.
- **Generate Migration Files**: Generates a migration file for creating the necessary database table.
- **Generate API Routes**: Adds the necessary routes for the CRUD operations to `api.php`.



##require : Laravel 10 , php 8.0

## Installation

1. Add the package to your Laravel project by running:

    ```bash
    composer require jatri/crud-generator
    ```

2. Publish the package assets:

    ```bash
    php artisan vendor:publish --provider="Jatri\CrudGenerator\CrudGeneratorServiceProvider"
    ```

## Usage

To generate CRUD operations for a model, use the `make:crud` Artisan command:

```bash
php artisan make:crud ModelName
