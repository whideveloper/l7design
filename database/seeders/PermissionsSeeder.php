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
            'curso'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'atividade'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
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
            'passp a passo'=>[
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
            'disciplina'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
                'Visualizar outras disciplinas'
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
