<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;
use App\Models\{Privilege, Profile};

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Administración',
                'url' => '',
                'icon' => 'pi pi-database',
                'parent_id' => null,
                'status' => true,
                'profiles' => ['ADMIN']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Biblioteca',
                'url' => '',
                'icon' => 'pi pi-database',
                'parent_id' => null,
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Configuración',
                'url' => '',
                'icon' => 'pi pi-cog',
                'parent_id' => null,
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
        ];

        




        $submenus = [
            
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Gestión de libros',
                'url' => '/books',
                'icon' => 'pi pi-book',
                'parent_id' => $menus[0]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Gestión de categorías',
                'url' => '/categories',
                'icon' => 'pi pi-objects-column',
                'parent_id' => $menus[0]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Gestión de prestamos',
                'url' => '/loans',
                'icon' => 'pi pi-book',
                'parent_id' => $menus[0]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Libros disponibles',
                'url' => '/books/client',
                'icon' => 'pi pi-book',
                'parent_id' => $menus[1]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Categorías disponibles',
                'url' => '/categories/client',
                'icon' => 'pi pi-objects-column',
                'parent_id' => $menus[1]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Mi carrito',
                'url' => '/loans/cart',
                'icon' => 'pi pi-shopping-cart',
                'parent_id' => $menus[1]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Prestamos',
                'url' => '/',
                'icon' => 'pi pi-receipt',
                'parent_id' => $menus[1]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
            [
                'id' => (string) \Str::uuid(),
                'name' => 'Gestión de perfil',
                'url' => '/',
                'icon' => 'pi pi-database',
                'parent_id' => $menus[2]['id'],
                'status' => true,
                'profiles' => ['ADMIN', 'STUDENT']
            ],
        ];


        foreach ($menus as $menu) {
            // $option = Option::create($menu);
            $option = Option::create([
                'id' => $menu['id'],
                'name' => $menu['name'],
                'url' => $menu['url'],
                'icon' => $menu['icon'],
                'parent_id' => $menu['parent_id'],
                'status' => $menu['status'],
            ]);

            
            $profileIds = Profile::whereIn('name', $menu['profiles'])->pluck('id');
            

            
            $option->profiles()->attach($profileIds);

            
        }

        foreach ($submenus as $submenu) {            
            $option = Option::create([
                'id' => $submenu['id'],
                'name' => $submenu['name'],
                'url' => $submenu['url'],
                'icon' => $submenu['icon'],
                'parent_id' => $submenu['parent_id'],
                'status' => $submenu['status'],
            ]);


            $profileIds = Profile::whereIn('name', $menu['profiles'])->pluck('id');
  
            $option->profiles()->attach($profileIds);
        }





        
    }
}