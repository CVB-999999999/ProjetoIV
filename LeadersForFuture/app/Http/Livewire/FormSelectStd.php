<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class FormSelectStd extends PowerGridComponent
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

        $id = Auth::user()->numero;

        // Gets the data to fill the form selection page
//        $forms = DB::select("exec buscaTodosDadosForms ?", [$id]);
        if(Auth::user()->id_tipoUtilizador == 3){
            $projs = DB::table('Utilizador_Projecto')
                //->where('numero_utilizador', '=', $id)
                ->join('Projecto', 'id_projecto', '=', 'id')
                ->join('Disciplina', 'id_disciplina', '=', 'cd_discip')
                ->get();
        } else {
            $projs = DB::table('Utilizador_Projecto')
                ->where('numero_utilizador', '=', $id)
                ->join('Projecto', 'id_projecto', '=', 'id')
                ->join('Disciplina', 'id_disciplina', '=', 'cd_discip')
                ->get();
        }
        //ddd($projs);
        $collection = collect();

        foreach ($projs as $proj) {
            $forms = DB::table('Formulario')
                ->where('id_projecto', '=', $proj->id)
                ->get();

            foreach ($forms as $form) {
                switch ($form->estado) {
                    case 0:
                        $estado = "Bloqueado";
                        break;
                    case 1:
                        $estado = "Ativo";
                        break;
                    case 2:
                        $estado = "Em Avaliação";
                        break;
                    case 3:
                        $estado = "Terminado";
                        break;
                    default:
                        $estado = "Desconhecido";
                        break;
                }

                $collection->push([
                    'id' => trim($form->id),
                    'nome' => $proj->nome,
                    'tema' => $proj->tema,
                    'estado' => $estado,
                    'disciplina' => $proj->cd_discip . " - " . $proj->ds_discip,
                    'ano_letivo' => $form->ano_letivo . "/" . $form->ano_letivo + 1,
                    'ano_curricular' => $form->ano_curricular,
                    'semestre' => $form->semestre,
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
    public function setUp(): void
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
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('nome')
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
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID Formulário')
                ->field('id')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Projeto')
                ->field('nome')
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
                ->title('Ano Curricular')
                ->field('ano_curricular')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Semestre')
                ->field('semestre')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Estado')
                ->field('estado')
                ->searchable()
                ->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('Ver Formulário')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                ->route('form.id', ['id' => 'id'])
                ->target('_self')
        ];
    }
}
