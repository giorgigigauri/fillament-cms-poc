<?php

namespace App\Filament\Resources\ContentManagerResource\Pages;

use App\Filament\Resources\ContentManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentManagers extends ListRecords
{
    protected static string $resource = ContentManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
