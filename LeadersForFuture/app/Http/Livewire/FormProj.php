<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

final class FormProj extends PowerGridComponent
{
    use ActionButton;

    // Changes the theme to a custom one
    public function template(): ?string
    {
        return \App\Http\Livewire\CustomTailwindTemplate::class;
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public $semestre = 1;
    public $formularios = "";
    public $anoLetivo;

    public function datasource(): ?Collection
    {
        $collection = collect();

        $profnumber = Auth::user()->numero;
        try{
            $query = DB::select("exec buscaProjProf ?", [$profnumber]);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            
        }

        foreach ($query as $queryres) {

            $q = DB::table('Formulario')
                ->select('estado')
                ->where('id_projecto', trim($queryres->id))
                ->get();

            $finished = 0;
            $aval = 0;
            foreach ($q as $qr) {
                if ($qr->estado == 3) {
                    $finished++;
                }
                if ($qr->estado == 2) {
                    $aval++;
                }
            }

            $collection->push([
                'id' => trim($queryres->id),
                'nome' => $queryres->nome,
                'ano_letivo' => $queryres->ano_letivo,
                'progresso' => $finished . "/" . sizeof($q),
                'aval' => $aval
            ]);
        }

        return $collection;
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): void
    {
        $this->showPerPage()
            ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('nome')
            ->addColumn('ano_letivo')
            ->addColumn('progresso')
            ->addColumn('aval');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |

    */
    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Nome do Projeto')
                ->field('nome')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Ano Letivo')
                ->field('ano_letivo')
                ->sortable(),

            Column::add()
                ->title('Em avaliação')
                ->field('aval')
                ->sortable(),

            Column::add()
                ->title('Terminados')
                ->field('progresso')
                ->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('Ver alunos')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                ->route('prof.aluno', ['id' => 'id'])
                ->target('_self')
        ];
    }

}
