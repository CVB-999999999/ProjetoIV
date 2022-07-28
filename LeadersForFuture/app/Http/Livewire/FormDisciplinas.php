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

final class FormDisciplinas extends PowerGridComponent
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
        try {
            $query = DB::select("SELECT * FROM Disciplina");
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
        }
        foreach ($query as $queryres) [
            $collection->push(['cd_discip' => $queryres->cd_discip, 'nome' => $queryres->ds_discip, 'sigla' => $queryres->sigla])
        ];
        //dd($query[0]->cd_discip);
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
            ->showCheckBox()
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv']);
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
            ->addColumn('cd_discip')
            ->addColumn('nome')
            ->addColumn('sigla');
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
                ->title('cd_discip')
                ->field('cd_discip')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Nome da disciplina')
                ->field('nome')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Sigla')
                ->field('sigla')
                ->sortable(),
        ];
    }

    /*public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('<span class="material-symbols-outlined align-middle h-7">info</span> Ver Mais')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 px-5 text-center rounded text-sm')
                ->route('admin.aluno', ['id' => 'id'])
                ->target('_self'),
            Button::add('btn')
                ->caption('<span class="material-symbols-outlined align-middle h-7">delete</span> Eliminar Projeto')
                ->class('bg-esce border border-zinc-900 text-white py-1.5 px-5 text-center rounded text-sm')
                ->openModal('apagar-projeto', ['id' => 'id'])
        ];
    }*/
}
