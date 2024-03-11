<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Añade esta línea
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles si no existen
        $this->createRoleIfNotExists('admin');
        $this->createRoleIfNotExists('client');
        $this->createRoleIfNotExists('pasante');
        $this->createRoleIfNotExists('vendedor');

        // Obtener roles creados manualmente a través del formulario
        $rolesCreadosManualmente = [
            // ['name' => 'nombre_del_rol_creado_manualmente']
        ];

        // Iterar sobre los roles creados manualmente y agregarlos al seeder
        foreach ($rolesCreadosManualmente as $rolManual) {
            $this->createRoleIfNotExists($rolManual['name']);
        }
    }

    /**
     * Crea un rol si no existe.
     *
     * @param string $roleName
     */
    private function createRoleIfNotExists(string $roleName): void
    {
        // Verificar si el rol ya existe antes de intentar crearlo
        $existingRole = Role::where('name', $roleName)->first();

        // Crear el rol solo si no existe
        if (!$existingRole) {
            Role::create(['name' => $roleName]);
        }
    }
}
