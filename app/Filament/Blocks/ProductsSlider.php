<?php
namespace App\Filament\Blocks;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ProductsSlider
{

    // heroslider should extend blocks base class to inherit the getName method that will be generated automatically by the Class Name
    public function getName()
    {
        return 'Product Slider';
    }
    public function getFields()
    {
        return [
            TextInput::make('maxProducts')
            ->required(),
            Select::make('productGroup')
                ->options([
                    '1' => 'Group 1',
                    '2' => 'Group 2',
                    '3' => 'Group 3',
                ])
                ->required(),
            ];
    }
}
