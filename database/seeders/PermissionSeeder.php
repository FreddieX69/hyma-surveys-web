<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $roles =  [
            'Trabajador social',
            'Médico',
            'Supervisor',
        ];
        $permissions = [
            'Dashboard',
            'Módulo usuarios',
            'Crear usuarios',
            'Eliminar usuarios',
            'Editar usuarios',
            'Perfil',
            'Módulo formularios',
            'Editar formulario',
            'Módulo ficha inicial',
            'Módulo estudio socioeconómico',
            'Lista roles',
            'Ver roles',
            'Crear roles',
            'Actualizar roles',
            'Eliminar roles',
            'Lista permisos',
            'Ver permisos',
            'Crear permisos',
            'Actualizar permisos',
            'Eliminar permisos',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $admin = Role::create(['name' => 'Administrador']);
        $admin->syncPermissions($permissions);
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
