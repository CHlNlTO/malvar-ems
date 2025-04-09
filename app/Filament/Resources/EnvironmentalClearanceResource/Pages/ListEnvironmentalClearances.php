<?php

namespace App\Filament\Resources\EnvironmentalClearanceResource\Pages;

use App\Filament\Resources\EnvironmentalClearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnvironmentalClearances extends ListRecords
{
    protected static string $resource = EnvironmentalClearanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Request'),
        ];
    }
}
