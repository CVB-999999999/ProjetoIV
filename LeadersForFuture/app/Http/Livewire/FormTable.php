<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

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

        
        $collection = collect([
            ['id' => 1, 'name' => 'Name 1', 'price' => 1.58, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 2, 'name' => 'Name 2', 'price' => 1.68, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 3, 'name' => 'Name 3', 'price' => 1.78, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 4, 'name' => 'Name 4', 'price' => 1.88, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
            ['id' => 5, 'name' => 'Name 5', 'price' => 1.98, 'ano_letivo' => $this->anoLetivo, 'created_at' => now(),],
        ]);

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
            ->addColumn('price')
            ->addColumn('ano_letivo')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
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
                ->title('Price')
                ->field('price')
                ->sortable()
                ->makeInputRange('price', '.', ''),
            
            Column::add()
                ->title('Ano Letivo')
                ->field('ano_letivo')
                ->sortable()
                ->makeInputRange('Ano_Letivo'),

            Column::add()
                ->title('Created At')
                ->field('created_at_formatted')
                ->makeInputDatePicker('created_at'),
        ];
    }
}
