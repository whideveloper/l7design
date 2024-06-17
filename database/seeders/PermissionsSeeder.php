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
            'especialidade'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'tutorial'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'treinamento'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'hospital'=>[
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
            'protocolo'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'material de apoio'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'agendamento'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'mural de comunicacao'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'Sav'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'lead'=>[
                'Visualizar',
                'Remover',
            ],
            'contato'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'google form'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'galeria'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'evento'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'mapa'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
            ],
            'quadro geral ubs'=>[
                'importar',
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
