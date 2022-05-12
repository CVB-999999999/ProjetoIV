<?php

namespace App\Http\Livewire;


use PowerComponents\LivewirePowerGrid\Themes\Components\{Actions,
    Checkbox,
    ClickToCopy,
    Cols,
    Editable,
    FilterBoolean,
    FilterDatePicker,
    FilterInputText,
    FilterMultiSelect,
    FilterNumber,
    FilterSelect,
    Footer,
    Row,
    Table
};

use PowerComponents\LivewirePowerGrid\Themes\Theme;
use PowerComponents\LivewirePowerGrid\Themes\ThemeBase;

class CustomTailwindTemplate extends ThemeBase
{
    public string $name = 'tailwind';

    public static function paginationTheme(): string
    {
        return 'tailwind';
    }

    public function table(): Table
    {
        return Theme::table('min-w-full divide-y divide-zinc-300 border-b dark:bg-zinc-800 border-zinc-400')
            ->thead('bg-zinc-50 dark:bg-zinc-900')
            ->tr('border border-zinc-200 dark:border-zinc-900')
            ->th('px-2 pr-4 py-3 text-left text-xs font-medium text-esce tracking-wider whitespace-nowrap dark:text-esce ')
            ->tbody('text-zinc-800')
            ->trBody('border border-zinc-200 dark:border-zinc-900 hover:bg-esce')
            ->tdBody('px-2 py-1 whitespace-nowrap dark:text-zinc-200')
            ->tdBodyTotalColumns('px-2 py-1 whitespace-nowrap dark:text-zinc-200 text-sm text-zinc-600 text-right space-y-2');
    }

    public function footer(): Footer
    {
        return Theme::footer()
            ->view($this->root() . '.footer')
            ->select('block appearance-none bg-zinc-50 border border-zinc-900 text-zinc-700 py-2 px-3 pr-8
                rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500  dark:bg-zinc-500
                dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900');
    }

    public function actions(): Actions
    {
        return Theme::actions()
            ->headerBtn('block w-full bg-zinc-50 text-zinc-700 border border-zinc-300 rounded py-2 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-zinc-600 dark:border-zinc-500
                dark:bg-zinc-900 2xl:dark:placeholder-zinc-300 dark:text-zinc-200 dark:text-zinc-300')
            ->rowsBtn('focus:outline-none text-sm py-2.5 px-5 rounded border');
    }

    public function cols(): Cols
    {
        return Theme::cols()
            ->div('')
            ->clearFilter('', '');
    }

    public function rows(): Row
    {
        return Theme::row()
            ->span('flex justify-between');
    }

    public function editable(): Editable
    {
        return Theme::editable()
            ->view($this->root() . '.editable')
            ->span('flex justify-between')
            ->input('dark:bg-zinc-700 bg-zinc-200 text-black-700 border border-zinc-200 rounded py-2 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 dark:bg-zinc-900
                dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900');
    }

    public function clickToCopy(): ClickToCopy
    {
        return Theme::clickToCopy()
            ->span('flex justify-between');
    }

    public function checkbox(): Checkbox
    {
        return Theme::checkbox()
            ->th('px-6 py-3 text-left text-xs font-medium text-zinc-500 tracking-wider')
            ->label('flex items-center space-x-3')
            ->input('h-4 w-4');
    }

    public function filterBoolean(): FilterBoolean
    {
        return Theme::filterBoolean()
            ->input('appearance-none block mt-1 mb-1 bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3
                pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black
                w-full active dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900',
                'max-width: 370px')
            ->divNotInline('pt-2 p-2')
            ->relativeDiv('pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700
                dark:bg-zinc-500 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-500')
            ->divInline('');
    }

    public function filterDatePicker(): FilterDatePicker
    {
        return Theme::filterDatePicker()
            ->input('flatpickr flatpickr-input block my-1 bg-zinc-50 border border-zinc-300 text-zinc-700 py-2
                px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black
                w-full active dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900',
                'min-width: 12rem')
            ->divNotInline('pt-2 p-2')
            ->divInline('');
    }

    public function filterMultiSelect(): FilterMultiSelect
    {
        return Theme::filterMultiSelect()
            ->view($this->root() . '.multi-select')
            ->input('appearance-none block mt-1 mb-1 bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3
                pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black
                w-full active dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900')
            ->divNotInline('pt-2 p-2')
            ->divInline('pr-6');
    }

    public function filterNumber(): FilterNumber
    {
        return Theme::filterNumber()
            ->input('block bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3 rounded leading-tight
                focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black w-full active dark:bg-zinc-900
                dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900', 'min-width: 4rem')
            ->divNotInline('pt-2 p-2')
            ->divInline('pr-6');
    }

    public function filterSelect(): FilterSelect
    {
        return Theme::filterSelect()
            ->input('appearance-none block mt-1 mb-1 bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3
                pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black
                w-full active dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900')
            ->divNotInline('pt-2 ml-2 p-2')
            ->relativeDiv('pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700
                dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900')
            ->divInline('pr-6');
    }

    public function filterInputText(): FilterInputText
    {
        return Theme::filterInputText()
            ->select('appearance-none block bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3 pr-8
                rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black w-full
                active dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900',
                'pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700')
            ->input('w-full block bg-zinc-50 text-zinc-700 border border-zinc-300 rounded py-2 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:text-black dark:bg-zinc-900
                dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900')
            ->divNotInline('mt-1')
            ->divInline('pr-6');
    }
}
