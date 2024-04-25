<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentEntryResource\Pages;
use App\Filament\Resources\ContentEntryResource\RelationManagers;
use App\Models\ContentEntry;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ContentEntryResource extends Resource
{
    protected static ?string $model = ContentEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')->columnSpanFull(),
                Builder::make('fields')->columnSpanFull()
                    ->blocks([
                        Builder\Block::make('Text')
                            ->schema([
                                TextInput::make('Name')
                                    ->label('Name')
                                    ->required(),
                                Select::make('Type')
                                    ->options([
                                        'Text' => 'Text',
                                        'LongText' => 'Long Text',
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                        Builder\Block::make('Date')
                            ->schema([
                                TextInput::make('Name')
                                    ->label('Name')
                                    ->required(),
                                Select::make('Type')
                                    ->options([
                                        'Date' => 'Date',
                                        'DateTime' => 'Date Time',
                                        'Time' => 'Time',
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                        Builder\Block::make('Component')
                            ->schema([
                                Select::make('Component')
                                    ->options(ContentEntry::all()->pluck('name'))
                                    ->required(),
                                Select::make('Type')
                                    ->options([
                                        'Repeatable' => 'Repeatable',
                                        'Single' => 'Single',
                                    ])
                                    ->required(),
                            ]),
                        Builder\Block::make('Relation')
                            ->schema([
                                Select::make('Model')
                                    ->options([
                                        'product' => 'Product',
                                        'brand' => 'Brand',
                                        'productGroup' => 'Product Group',
                                    ])
                                    ->required(),
                                Select::make('Component')
                                    ->options(ContentEntry::all()->pluck('name'))
                                    ->required(),
                            ]),
                    ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListContentEntries::route('/'),
            'create' => Pages\CreateContentEntry::route('/create'),
            'edit' => Pages\EditContentEntry::route('/{record}/edit'),
        ];
    }
}
