<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentManagerResource\Pages;
use App\Filament\Resources\ContentManagerResource\RelationManagers;
use App\Models\ContentManager;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContentManagerResource extends Resource
{
    protected static ?string $model = ContentManager::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $page = \App\Models\Page::find(1);
        foreach ($page->entries as $entry) {
            $entryData = \App\Models\ContentEntry::find($entry)->first();
            $fields = [];
            foreach($entryData->fields as $field) {
                $fields[] = TextInput::make($field['data']['Name']);
            }
            $sections[] = Section::make($entryData->name)
                ->schema(
                    $fields
                );
        }

        return $form
            ->schema([
                Section::make('content')->statePath('content')
                    ->schema(
                        $sections
                    ),
                Forms\Components\Select::make('page_id')
                    ->options(\App\Models\Page::all()->pluck('name', 'id'))->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListContentManagers::route('/'),
            'create' => Pages\CreateContentManager::route('/create'),
            'edit' => Pages\EditContentManager::route('/{record}/edit'),
        ];
    }
}
