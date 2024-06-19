<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadExport implements FromCollection, WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Seleciona apenas os campos específicos da tabela leads e conta as visualizações
        $leads = Lead::select('video_title', 'name', 'email')
            ->get()
            ->groupBy('video_title');

        // Cria uma coleção para armazenar os dados formatados
        $formattedLeads = new Collection();

        // Itera sobre cada grupo e formata os dados
        foreach ($leads as $group) {
            $totalViews = $group->count(); // Conta o total de visualizações

            foreach ($group as $lead) {
                $formattedLeads->push((object) [
                    'video_title' => $lead->video_title,
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'total_views' => $totalViews,
                ]);
            }
        }

        return $formattedLeads;
    }

    /**
    * Define os cabeçalhos da planilha
    * @return array
    */
    public function headings(): array
    {
        return [
            'Vídeo',
            'Nome',
            'E-mail',
            'Total de Visualizações',
        ];
    }
}
