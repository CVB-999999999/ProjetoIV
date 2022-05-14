<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ObsTable extends PowerGridComponent
{
    use ActionButton;

    public $formID;
    private $query;

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

        $query = DB::select("exec buscaObs ?", [$this->formID]);

        foreach ($query as $q) {

            $apr = 'Não Aprovado';

            if ($q->aprovado == 1) {
                $apr = 'Aprovado';

                $collection->push([
                    'id' => $q->idProf,
                    'name' => $q->nome . ' ' . $q->apelido,
                    'status' => $apr,
                    'created_at' => $q->dataHora,
                    'obs' => $q->conteudo,
                ]);
            }
        }

        $this->query = $query;

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
            ->showSearchInput()
            ->showRecordCount('full');
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
            ->addColumn('status')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y H:m');
            })
            ->addColumn('obs');
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
                ->title('Professor')
                ->field('name')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Estado')
                ->field('status')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('Criado em')
                ->sortable()
                ->field('created_at_formatted'),

            Column::add()
                ->title('Observação')
                ->sortable()
                ->field('obs')
                ->hidden(),
        ];
    }

// Create an Action Button for ordering a dish.
    public function actions(): array
    {
        return [
            Button::add('obs')
                ->caption('Ver Observação')
                ->class('block bg-esce border border-zinc-900 text-white p-3 py-2 m-1 rounded text-sm')
                ->openModal('view-obs', ['obs' => 'obs'])
        ];
    }
}
