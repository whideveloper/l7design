<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'banners'=>[
                'Visualizar',
                'Criar',
                'Editar',
                'Remover',
                ],
            'grupo'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover'
            ],
            'usuario'=>[
                'Alterar',
                'Criar',
                'Editar',
                'Visualizar',
                'Remover']
            ];

        foreach($permissions as $key => $permission){
            foreach($permission as $value){
                Permission::create([
                    'name'=>strtolower("{$key}.{$value}")
                ]);
            }
        }   
    }
    
}
