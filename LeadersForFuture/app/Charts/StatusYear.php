<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusYear extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $ano = explode( '-', $request->year);
        $dados = DB::select("exec buscaFormsAnoLetivo ?", [$ano[0]]);

        // Status First Year
        $estado1 = [0, 0, 0, 0];
        // Status Second Year
        $estado2 = [0, 0, 0, 0];
        // Status Third Year
        $estado3 = [0, 0, 0, 0];
        // Other Years
        $estado4 = [0, 0, 0, 0];

        foreach ($dados as $dado) {
            if ($dado->semestre == $ano[1]) {
                // First Year
                if ($dado->ano_curricular == 1) {
                    if ($dado->estado == 0) {
                        $estado1[0] += 1;
                    } elseif ($dado->estado == 1) {
                        $estado1[1] += 1;
                    } elseif ($dado->estado == 2) {
                        $estado1[2] += 1;
                    } elseif ($dado->estado == 3) {
                        $estado1[3] += 1;
                    }
                    // Second Year
                } elseif ($dado->ano_curricular == 2) {
                    if ($dado->estado == 0) {
                        $estado2[0] += 1;
                    } elseif ($dado->estado == 1) {
                        $estado2[1] += 1;
                    } elseif ($dado->estado == 2) {
                        $estado2[2] += 1;
                    } elseif ($dado->estado == 3) {
                        $estado2[3] += 1;
                    }
                    // Third Year
                } elseif ($dado->ano_curricular == 3) {
                    if ($dado->estado == 0) {
                        $estado3[0] += 1;
                    } elseif ($dado->estado == 1) {
                        $estado3[1] += 1;
                    } elseif ($dado->estado == 2) {
                        $estado3[2] += 1;
                    } elseif ($dado->estado == 3) {
                        $estado3[3] += 1;
                    }
                    // Other Years
                } else {
                    if ($dado->estado == 0) {
                        $estado4[0] += 1;
                    } elseif ($dado->estado == 1) {
                        $estado4[1] += 1;
                    } elseif ($dado->estado == 2) {
                        $estado4[2] += 1;
                    } elseif ($dado->estado == 3) {
                        $estado4[3] += 1;
                    }
                }
            }
        }

        return Chartisan::build()
            ->labels(['Bloqueado', 'Em Progresso', 'Em Avaliação', 'Terminado'])
            ->dataset('Primeiro Ano', $estado1)
            ->dataset('Segundo Ano', $estado2)
            ->dataset('Terceiro Ano', $estado3)
            ->dataset('Outros Anos', $estado4);
    }
}
