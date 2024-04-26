<?php
namespace App\Filament\Blocks;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class HeroSlider
{

    // heroslider should extend blocks base class to inherit the getName method that will be generated automatically by the Class Name
    public function getName()
    {
        return 'Hero Slider';
    }
    public function getFields()
    {
        return [
            Repeater::make('slides')->columnSpanFull()
                ->schema([
                    TextInput::make('content')
                        ->label('Heading')
                        ->required(),
                    Select::make('Tag')
                        ->options([
                            'h1' => 'Heading 1',
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                        ])
                        ->required(),
                ]),
            ];
    }
}
