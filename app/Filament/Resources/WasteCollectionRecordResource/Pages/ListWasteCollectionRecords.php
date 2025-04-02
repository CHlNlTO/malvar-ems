<?php

namespace App\Filament\Resources\WasteCollectionRecordResource\Pages;

use App\Filament\Resources\WasteCollectionRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasteCollectionRecords extends ListRecords
{
    protected static string $resource = WasteCollectionRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
