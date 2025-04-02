<?php

namespace App\Filament\Resources\GarbageCollectionScheduleResource\Pages;

use App\Filament\Resources\GarbageCollectionScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGarbageCollectionSchedule extends EditRecord
{
    protected static string $resource = GarbageCollectionScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
