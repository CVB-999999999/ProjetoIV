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

final class FormAluno extends PowerGridComponent
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
        $id = \Request::segment(3);

        $query = DB::select("exec buscaAlunosProj ?", [$id]);
        foreach($query as $queryres){
            if($queryres->id_tipoUtilizador == 2){
                $collection->push(['id' => trim($queryres->numero), 'nome' => trim($queryres->nome) . " " . trim($queryres->apelido)]);
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
            ->addColumn('nome');
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
                ->title('Nome')
                ->field('nome')
                ->searchable()
                ->sortable(),

        ];
    }

    public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('Ver mais')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                ->route('prof.users.info', ['id' => 'id'])
                ->target('_self')
        ];
    }

}
