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

final class FormTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {

        if (Auth::user()->id_tipoUtilizador == 3) {
            $projs = DB::table('Utilizador_Projecto')
                ->join('Projecto', 'id_projecto', '=', 'id')
                ->join('Disciplina', 'id_disciplina', '=', 'cd_discip')
                ->get();
        } else {
            $id = Auth::user()->numero;

            // Gets the data to fill the form selection page

            $projs = DB::table('Utilizador_Projecto')
                ->where('numero_utilizador', '=', $id)
                ->join('Projecto', 'id_projecto', '=', 'id')
                ->join('Disciplina', 'id_disciplina', '=', 'cd_discip')
                ->get();
        }

        $collection = collect();

        foreach ($projs as $proj) {
            $forms = DB::table('Formulario')
                ->where('id_projecto', '=', $proj->id)
                ->get('estado');

            /*$b = $a = $aval = */
            $t = 0;

            foreach ($forms as $form) {
                switch ($form->estado) {
//                    case 0:
//                        $b++;
//                        break;
//                    case 1:
//                        $a++;
//                        break;
//                    case 2:
//                        $aval++;
//                        break;
                    case 3:
                        $t++;
                        break;
                }
            }


            $user = DB::table('Utilizador')
                ->where('numero', '=', $proj->numero_utilizador)
                ->first();


            if ($user->id_tipoUtilizador == 2) {

                $collection->push([
                    'id' => trim($user->numero),
                    'nome' => $user->nome . " " . $user->apelido,
                    'idP' => trim($proj->id_projecto),
                    'nomeP' => $proj->nome,
                    'tema' => $proj->tema,
                    'estado' => $t . " formulário(s) em " . sizeof($forms),
                    'disciplina' => $proj->cd_discip . " - " . $proj->ds_discip,
                    'ano_letivo' => $proj->ano_letivo . "/" . $proj->ano_letivo + 1,
                ]);
            }
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
    public
    function setUp(): void
    {
        $this->showPerPage(25)
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
    public
    function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('nome')
            ->addColumn('idP')
            ->addColumn('nomeP')
            ->addColumn('tema')
            ->addColumn('disciplina')
            ->addColumn('ano_letivo')
            ->addColumn('ano_curricular')
            ->addColumn('semestre')
            ->addColumn('estado');
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
    public
    function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Aluno')
                ->field('nome')
                ->searchable()
                ->sortable(),

//            Column::add()
//                ->title('ID Projeto')
//                ->field('idP')
//                ->searchable()
//                ->sortable(),

            Column::add()
                ->title('Projeto')
                ->field('nomeP')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Tema')
                ->field('tema')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Disciplina')
                ->field('disciplina')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Ano Letivo')
                ->field('ano_letivo')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Formulários Validados')
                ->field('estado')
                ->searchable()
                ->sortable(),
        ];
    }

    public
    function actions(): array
    {
        if (Auth::user()->id_tipoUtilizador == 1) {
            return [
                Button::add('btn')
                    ->caption('<span class="material-symbols-outlined align-middle h-7">info</span> Visualizar Detalhes')
                    ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                    ->route('prof.aluno', ['id' => 'idP'])
                    ->target('_self'),
            ];
        } else {
            return [
                Button::add('btn')
                    ->caption('<span class="material-symbols-outlined align-middle h-7">info</span> Visualizar Detalhes')
                    ->class('block bg-esce border border-zinc-900 text-white py-1.5 px-5 text-center rounded text-sm')
                    ->route('admin.aluno', ['id' => 'idP'])
                    ->target('_self'),
            ];
        }
    }
}

