<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
                    $collection->push(['id' => $query2result->numero_utilizador, 'name' => $query3[0], 'ano_letivo' => $this->anoLetivo,]);
                }
           }
        }
        //dd($query[0]);
        /*for($i=0;$i<2;$i++){
            $query2 = DB::table("Utilizador_Projecto")->where('id_projecto',$query[$i]->id_projecto)->get();
            //dd($query2);
            $query3 = DB::table("Utilizador")->where('numero',$query2[0]->numero_utilizador)->pluck('nome');
            //dd($query3[0]);
            //['id' => $query2[0]->numero_utilizador, 'name' => $query3[0], 'ano_letivo' => $this->anoLetivo,]]);
            $collection->push(['id' => $query2[0]->numero_utilizador, 'name' => $query3[0], 'ano_letivo' => $this->anoLetivo,]);
        }*/
        //dd($collection);
        /*$collection = collect([
            ['id' => 1, 'name' => 'Paulo', 'ano_letivo' => $this->anoLetivo,],
            ['id' => 2, 'name' => 'Name 2', 'price' => 1.68, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 3, 'name' => 'Name 3', 'price' => 1.78, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 4, 'name' => 'Name 4', 'price' => 1.88, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 5, 'name' => 'Name 5', 'price' => 1.98, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
        ]);*/
        //dd($collection);
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
            ->showExportOption('download', ['pdf', 'csv'])
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
            ->addColumn('ano_letivo');
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

        ];
    }
    public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('Ver mais')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                ->route('prof.users.info', ['id'=>'id'])
                ->target('_self')
        ];
    }
    
}
