Spatie Laravel Permission - Tutorial básico en Español.

1. Crear tu proyecto laravel:
```composer create-project laravel/laravel "Laravel-Permission" --prefer-dist```

2. Instalar UI y Bootstrap:
```composer require laravel/ui``` ```php artisan ui:auth``` ```php artisan ui bootstrap``` ```npm install && npm run dev```

3. Instalar Spatie Laravel Permission:
```composer require spatie/laravel-permission```

4. Añadir el service provider en el fichero ```config/app.php```:
```'providers' => [
// ...
Spatie\Permission\PermissionServiceProvider::class,
],
```

5. Añadir también al middleware en el fichero ```Kernel.php```:
```protected $routeMiddleware = [
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
];
```

6. Crear las migraciones:
```php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"```
```php artisan optimize:clear``` Y ```php artisan config:clear```
```php artisan migrate```

7. Crear Seeders:
```php artisan make:seed roles_and_permissions_seed```
Se creará el fichero 'roles_and_permissions_seed' dentro de database/seed.

Añadimos los import:
```use Spatie\Permission\Models\Permission;```
```use Spatie\Permission\Models\Role;```

Ejemplo básico de creación de Roles y asignación de Permisos:
```public function run()
    {
        Permission::create(['name' => 'access-admin']);
        Permission::create(['name' => 'access-myaccount']);
        Permission::create(['name' => 'access-contact']);
        Permission::create(['name' => 'access-viewusers']);
        Permission::create(['name' => 'access-editusers']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
        'access-admin',
        'access-myaccount',
        'access-contact',
        'access-viewusers',
        'access-editusers'
        ]);

        $subadmin = Role::create(['name' => 'subadmin']);
        $subadmin->givePermissionTo([
        'access-myaccount',
        'access-contact',
        'access-viewusers'
        ]);

        $user = Role::create(['name' => 'user']);
        $subadmin->givePermissionTo(['access-myaccount', 'access-contact']);
    }
```
    
    
8. Ejecutamos el seed:
```php artisan db:seed --class=roles_and_permissions_seed```


9. En la vista de registro, añadimos un radio para escoger el tipo de rol:
```<div class="form-group row">
   <label for="role" class="col-md-4 col-form-label text-md-right">Choose your role</label>
   <div class="col-md-6">
      <input type="radio" id="huey" name="role" value="admin" checked> Admin
      <br/>
      <input type="radio" id="huey" name="role" value="subadmin" checked> Sub-Admin
      <br/>
      <input type="radio" id="huey" name="role" value="user" checked> Common User
   </div>
</div>
```

10. Recogemos los roles en el registro y asignamos dependiendo el tipo de rol que nos llegue:

```$user = User::orderBy('id', 'desc')->first();
if($data['role'] == 'admin'){
  $user->assignRole('admin');
}

if($data['role'] == 'subadmin'){
  $user->assignRole('subadmin');
}

if($data['role'] == 'user'){
  $user->assignRole('user');
}
```


11. Creamos las rutas de acceso y usamos los middleware:
```Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware('permission:access-admin');
...
```

12. Creamos enlaces hacia las rutas en el home:
(Con @can únicamente podrán ver estos enlaces los usuarios cuyo rol tengan el privilegio indicado)

```@can('access-admin')
   <p><a href="{{route('admin')}}">Administration</a></p>
@else
   <p><a style="color:gray;">Administration</a></p>
@endcan
```

13. Intentando acceder a rutas que no tenemos acceso introducciendo manualmente el enlace:
De intentar esto, lo único que obtendremos será esta imagen:
https://i.imgur.com/eshkOen.png

---------------------------------------------------FIN-------------------------------------------

Más información: https://github.com/spatie/laravel-permission && https://spatie.be/docs/laravel-permission/v3/basic-usage/basic-usage
