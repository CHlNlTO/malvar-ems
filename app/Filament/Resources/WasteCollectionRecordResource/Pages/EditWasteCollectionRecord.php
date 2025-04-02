<?php

namespace App\Filament\Resources\WasteCollectionRecordResource\Pages;

use App\Filament\Resources\WasteCollectionRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteCollectionRecord extends EditRecord
{
    protected static string $resource = WasteCollectionRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
