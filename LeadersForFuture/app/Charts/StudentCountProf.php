<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentCountProf extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $ano = explode( '-', $request->year);
        $dados = DB::select("exec buscaTodosAlunos");

        return Chartisan::build()
            ->labels(['1º ano', '2º ano', '3º ano', 'Outro'])
            ->dataset('Sample 2', [3, 2, 1, 0]);
    }
}
