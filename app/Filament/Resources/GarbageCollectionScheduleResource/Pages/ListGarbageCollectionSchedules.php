<?php

namespace App\Filament\Resources\GarbageCollectionScheduleResource\Pages;

use App\Filament\Resources\GarbageCollectionScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGarbageCollectionSchedules extends ListRecords
{
    protected static string $resource = GarbageCollectionScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
