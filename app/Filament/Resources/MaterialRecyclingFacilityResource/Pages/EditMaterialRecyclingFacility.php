<?php

namespace App\Filament\Resources\MaterialRecyclingFacilityResource\Pages;

use App\Filament\Resources\MaterialRecyclingFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialRecyclingFacility extends EditRecord
{
    protected static string $resource = MaterialRecyclingFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
