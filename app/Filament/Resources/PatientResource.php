<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\File;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static $depth = 3;

    public static function getAllClassesInNamespace($namespace) {
        $classes = [];

        $files = File::allFiles(app_path());

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $fileNamespace = str_replace('/', '\\', 'App' . substr($filePath, strlen(app_path()), -4));

            if ($fileNamespace == $namespace) {
                $classes[] = $namespace . '\\' . $file->getBasename('.php');
            }
        }

        return $classes;
    }

    public static function getFields()
    {
        return [
            Select::make('type')
                ->options([
                    'brand' => 'Brand',
                    'product' => 'Attribute',
                    ])
                ->required(),
            Select::make('operator')
                ->options([
                    'equals' => '=',
                    'notequals' => '!=',
                    'in' => 'in',
                    ])
                ->required(),
            Select::make('value')
                ->options(fn (Get $get): array => match ($get('type')) {
                    'brand' => [['id' => 1, 'name' => 'ბრენდი']],
                    'product' => [['id' => 1, 'name' => 'პროდუქტი']],
                    default => [],
                }),            Select::make('logical_operator')
                ->options([
                    'and' => 'and',                    'or' => 'or',                ])
                ->required()
        ];
    }
    public static function getFieldTypes()
    {
        return ['Text' => S];
    }
    public static function getForm($depth = 0)
    {
        foreach (self::getFieldTypes() as $class) {
            echo $class . "<br>";
        }
        return \Filament\Forms\Components\Builder::make('content')
            ->blocks([
                Block::make('filter')
                    ->schema(static::getFields()),
                Block::make('group')
                    ->schema(
                        self::$depth > $depth ? [self::getForm(++$depth)] : []
                            + [
                                Select::make('logical_operator')
                                    ->options([
                                        'and' => 'and','or' => 'or'])
                                    ->required(),
                            ]),
            ]);
    }
    public static function form(Form $form): Form
    {
        return $form         ->schema([
            static::getForm()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('owner.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
