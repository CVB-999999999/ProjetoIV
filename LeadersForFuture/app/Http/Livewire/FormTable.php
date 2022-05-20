<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
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
    public $semestre = 1 ;
    public $formularios = "";
    public $anoLetivo;
    
    public function datasource(): ?Collection
    {
        $collection = collect();
        $profnumber = Session::get('numero');
        $query = DB::table("Utilizador_Projecto")->where('numero_utilizador',$profnumber)->get();
        foreach ($query as $queryresult){
            $query2 = DB::table("Utilizador_Projecto")->where('id_projecto',$queryresult->id_projecto)->get();
           foreach($query2 as $query2result){
                $query3 = DB::table("Utilizador")->where('numero',$query2result->numero_utilizador)->pluck('nome');
                if($query2result->numero_utilizador != $profnumber){

                    foreach ($query2result as $queryresult){
                        $query4 = DB::table("Projecto")->where('id',$query2result->id_projecto)->get();
                    }
                   
                    $collection->push(['id' => $query2result->numero_utilizador, 'name' => $query3[0], 'ano_letivo' => $this->anoLetivo, 'projeto' => $query4[0]->nome]);
                }
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
        $this->showCheckBox()
            ->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
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
            ->addColumn('name')
            ->addColumn('ano_letivo')
            ->addColumn('projeto');
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
                ->title('Name')
                ->field('name')
                ->searchable()
                ->makeInputText('name')
                ->sortable(),
            
            Column::add()
                ->title('Ano Letivo')
                ->field('ano_letivo')
                ->sortable()
                ->makeInputRange('Ano_Letivo'),

            Column::add()
                ->title('Projeto')
                ->field('projeto')
                ->searchable()
                ->makeInputText('projeto'),

        ];
    }
}
