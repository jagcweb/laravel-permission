Spatie Laravel Permission - Tutorial básico en Español.

1. Crear tu proyecto laravel: ```composer create-project laravel/laravel "Laravel-Permission" --prefer-dist```

2. Instalar UI y Bootstrap: ```composer require laravel/ui``` ```php artisan ui:auth``` ```php artisan ui bootstrap``` ```npm install && npm run dev```

3. Instalar Spatie Laravel Permission: ```composer require spatie/laravel-permission```

4. Añadir el service provider en el fichero ```config/app.php```: ```'providers' => [Spatie\Permission\PermissionServiceProvider::class,]```

5. Añadir también al middleware en el fichero ```Kernel.php```: ```protected $routeMiddleware = ['role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,]```
