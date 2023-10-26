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
            'aluno'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
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
            'disciplina'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
                'Visualizar outras disciplinas'
            ],
            'professor'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
                'Restaurar dados',
                'Visualizar outros professores',
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
