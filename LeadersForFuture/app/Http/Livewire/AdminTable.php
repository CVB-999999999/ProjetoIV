<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class AdminTable extends PowerGridComponent
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
    public function datasource(): ?Collection
    {
        $collection = collect();

        $query = DB::select("exec buscaTodosUtiliz");

        foreach ($query as $q) {

            $collection->push([
                'id' => trim($q->numero),
                'Nome' => $q->nome . ' ' . $q->apelido,
                'Tipo' => $q->descricao,
                'Email' => $q->email,
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
            ->addColumn('Nome')
            ->addColumn('Tipo')
            ->addColumn('Email');
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
                ->title('Número')
                ->field('id')
                ->searchable()
//                ->makeInputRange('id')
                ->sortable(),

            Column::add()
                ->title('Nome')
                ->field('Nome')
                ->searchable()
//                ->makeInputText('Nome')
                ->sortable(),

            Column::add()
                ->title('Tipo')
                ->field('Tipo')
                ->searchable()
                ->sortable(),
//                ->makeInputText('Tipo'),

            Column::add()
                ->title('Email')
                ->field('Email')
                ->sortable()
                ->searchable(),
//                ->makeInputText('Email'),
        ];
    }

    // Create an Action Button for ordering a dish.
    public function actions(): array
    {
        return [
            Button::add('btn')
                ->caption('Ver mais')
                ->class('block bg-esce border border-zinc-900 text-white py-1.5 text-center rounded text-sm')
                ->route('admin.users.info', ['id' => 'id'])
                ->target('_self')
        ];
    }
}
