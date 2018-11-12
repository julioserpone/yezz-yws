<?php

/**
 * Akkar Global Services - Menu Routes Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 26 - 2016)
 */

use App\MenuRoute;
use Illuminate\Database\Seeder;

class MenuRoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //Master routes
        $routes = Array(
            ['code'=>'dashboard', 'name_en'=>'Dashboard', 'name_es'=>'Dashboard', 'icon'=>'fa fa-bar-chart', 'route'=>'dashboard', 'roles'=>['admin','callcenter','analist','manager','workshop']],
            ['code'=>'maintenance', 'name_en'=>'Maintenance', 'name_es'=>'Mantenimiento', 'icon'=>'fa fa-cogs', 'route'=>null, 'roles'=>['admin','analist','manager']],
            ['code'=>'clients', 'name_en'=>'Clients', 'name_es'=>'Clientes', 'icon'=>'fa fa-users', 'route'=>'client.index', 'roles'=>['admin','callcenter','analist','manager']],
            ['code'=>'products', 'name_en'=>'Products', 'name_es'=>'Productos', 'icon'=>'fa fa-tablet', 'route'=>null, 'roles'=>['admin','analist','manager']],
            ['code'=>'orders', 'name_en'=>'Orders', 'name_es'=>'Ordenes', 'icon'=>'fa fa-folder-open', 'route'=>'order.index', 'roles'=>['admin','callcenter','analist','manager','workshop','client','store']],
            ['code'=>'reports', 'name_en'=>'Reports', 'name_es'=>'Reportes', 'icon'=>'fa fa-print', 'route'=>'report.index', 'roles'=>['admin','callcenter','analist','manager','workshop','client','store']],
            ['code'=>'client_information', 'name_en'=>'Customer Information', 'name_es'=>'Informacion del Cliente', 'icon'=>'fa fa-print', 'route'=>'client.edit.profile', 'roles'=>['client','store']],
        );

        foreach ($routes as $route) {
            MenuRoute::create([
                'code' => $route['code'],
                'route' => $route['route'],
                'icon' => $route['icon'],
                'roles' => implode(",",$route['roles']),
                'en'  => ['name' => $route['name_en']],
                'es'  => ['name' => $route['name_es']]
            ]);
        }

        //Menu Maintenance
        $parent = MenuRoute::where('code', 'maintenance')->first();
        $routes = Array(
            ['code'=>'users', 'name_en'=>'Users', 'name_es'=>'Usuarios', 'icon'=>'fa fa-users', 'route'=>'user.index', 'roles'=>['admin','manager']],
            ['code'=>'countries', 'name_en'=>'Countries', 'name_es'=>'Paises', 'icon'=>'fa fa-globe', 'route'=>'country.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'provinces', 'name_en'=>'Provinces', 'name_es'=>'Estados', 'icon'=>'fa fa-globe', 'route'=>'province.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'cities', 'name_en'=>'Cities', 'name_es'=>'Ciudades', 'icon'=>'fa fa-globe', 'route'=>'city.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'chains', 'name_en'=>'Chains', 'name_es'=>'Cadenas', 'icon'=>'fa fa-link', 'route'=>'chain.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'couriers', 'name_en'=>'Couriers', 'name_es'=>'Carriers', 'icon'=>'fa fa-plane', 'route'=>'courier.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'workshops', 'name_en'=>'Workshops', 'name_es'=>'Talleres', 'icon'=>'fa fa-industry', 'route'=>'workshop.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'failures', 'name_en'=>'Failures', 'name_es'=>'Fallas', 'icon'=>'fa fa-wrench', 'route'=>'failure.index', 'roles'=>['admin','manager']],
            ['code'=>'routes', 'name_en'=>'Routes', 'name_es'=>'Rutas', 'icon'=>'fa fa-arrow-circle-up', 'route'=>'route.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'colors', 'name_en'=>'Colors', 'name_es'=>'Colores', 'icon'=>'fa fa-magic', 'route'=>'color.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'menu', 'name_en'=>'Menu', 'name_es'=>'Menu', 'icon'=>'fa fa-sitemap', 'route'=>'menu.index', 'roles'=>['admin']],
            ['code'=>'states', 'name_en'=>'States', 'name_es'=>'Estatus', 'icon'=>'fa fa-list-alt', 'route'=>'state.index', 'roles'=>['admin']],
        );

        foreach ($routes as $route) {
            MenuRoute::create([
                'parent_id' => $parent->id,
                'code' => $route['code'],
                'route' => $route['route'],
                'icon' => $route['icon'],
                'roles' => implode(",",$route['roles']),
                'en'  => ['name' => $route['name_en']],
                'es'  => ['name' => $route['name_es']]
            ]);
        }

        //Menu Products
        $parent = MenuRoute::where('code', 'products')->first();
        $routes = Array(
            ['code'=>'brands', 'name_en'=>'Brands', 'name_es'=>'Marcas', 'icon'=>'fa fa-bookmark', 'route'=>'brand.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'families', 'name_en'=>'Families', 'name_es'=>'Familia', 'icon'=>'fa fa-share-alt-square', 'route'=>'family.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'producttypes', 'name_en'=>'Product Types', 'name_es'=>'Tipos de Productos', 'icon'=>'fa fa-tasks', 'route'=>'producttype.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'scales', 'name_en'=>'Class', 'name_es'=>'Clases', 'icon'=>'fa fa-bars', 'route'=>'scale.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'technologies', 'name_en'=>'Technologies', 'name_es'=>'Tecnologias', 'icon'=>'fa fa-server', 'route'=>'technology.index', 'roles'=>['admin','analist','manager']],
            ['code'=>'products', 'name_en'=>'Products', 'name_es'=>'Productos', 'icon'=>'fa fa-tablet', 'route'=>'product.index', 'roles'=>['admin','analist','manager']],
        );

        foreach ($routes as $route) {
            MenuRoute::create([
                'parent_id' => $parent->id,
                'code' => $route['code'],
                'route' => $route['route'],
                'icon' => $route['icon'],
                'roles' => implode(",",$route['roles']),
                'en'  => ['name' => $route['name_en']],
                'es'  => ['name' => $route['name_es']]
            ]);
        }
    }
}
