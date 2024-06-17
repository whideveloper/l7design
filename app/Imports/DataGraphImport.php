<?php

namespace App\Imports;

use App\Models\DataGraph;
use Maatwebsite\Excel\Concerns\ToModel;

class DataGraphImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // Verificar se pelo menos um dos campos obrigatórios não está vazio (contando de 1 a 15)
       for ($i = 1; $i <= 15; $i++) {
        if (!empty($row[$i])) {
            return new DataGraph([
                'cnes' => $row[0],
                'health_unit' => $row[1],
                'county' => $row[2],
                'health_region' => $row[3],
                'cardiology' => $row[4],
                'endocrinology_and_metabology' => $row[5],
                'nursing' => $row[6],
                'family_and_community_medicine' => $row[7],
                'physiatry' => $row[8],
                'neurology' => $row[9],
                'neuropediatrics' => $row[10],
                'nutritionist' => $row[11],
                'psychiatry' => $row[12],
                'child_and_adolescent_psychiatry' => $row[13],
                'urology' => $row[14],
            ]);
        }
    }
        // Se a linha estiver vazia, retornar null para não importar
        return null;
    }
}
