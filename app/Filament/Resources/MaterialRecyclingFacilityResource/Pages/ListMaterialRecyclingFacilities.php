<?php

namespace App\Filament\Resources\MaterialRecyclingFacilityResource\Pages;

use App\Filament\Resources\MaterialRecyclingFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialRecyclingFacilities extends ListRecords
{
    protected static string $resource = MaterialRecyclingFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
