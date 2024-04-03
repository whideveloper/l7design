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
            'auditoria'=>[
                'Visualizar',
            ],
            'banners'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'formulario de contato'=>[
                'Editar',
                'Visualizar',
                'Remover'
            ],
            'grupo'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover'
            ],
            'telenordeste'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'teleinterconsulta'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'proadi'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'depoimento'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'passo a passo'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'como funciona'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'localizacao'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'objetivo'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'parceiro'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'usuario'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
                'Restaurar dados',
                'Visualizar outros usuarios',
                'Atribuir grupos']
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
