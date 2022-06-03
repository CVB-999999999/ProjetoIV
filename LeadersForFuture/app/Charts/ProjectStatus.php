<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectStatus extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $dados = DB::select("exec buscaFormsAnoLetivo ?", [$request->year]);

        // Status First Semester
        $estado0 = 0;
        $estado1 = 0;
        $estado2 = 0;
        $estado3 = 0;
        // Status Second Semester
        $estado10 = 0;
        $estado11 = 0;
        $estado12 = 0;
        $estado13 = 0;

        foreach ($dados as $dado) {
            // First Semester
            if ($dado->semestre == 0) {
                if ($dado->estado == 0) {
                    $estado0 += 1;
                } elseif ($dado->estado == 1) {
                    $estado1 += 1;
                } elseif ($dado->estado == 2) {
                    $estado2 += 1;
                } elseif ($dado->estado == 3) {
                    $estado3 += 1;
                }
                // Second Semester
            } else {
                if ($dado->estado == 0) {
                    $estado10 += 1;
                } elseif ($dado->estado == 1) {
                    $estado11 += 1;
                } elseif ($dado->estado == 2) {
                    $estado12 += 1;
                } elseif ($dado->estado == 3) {
                    $estado13 += 1;
                }
            }
        }

        return Chartisan::build()
            ->labels(['Bloqueado', 'Em Progresso', 'Em Avaliação', 'Terminado'])
            ->dataset(
                'Primeiro Semestre',
                [$estado0, $estado1, $estado2, $estado3])
            ->dataset(
                'Segundo Semestre',
                [$estado10, $estado11, $estado12, $estado13]
            );
    }
}
