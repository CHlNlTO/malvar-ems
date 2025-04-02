<?php

namespace App\Filament\Resources\EnvironmentalClearanceResource\Pages;

use App\Filament\Resources\EnvironmentalClearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnvironmentalClearance extends EditRecord
{
    protected static string $resource = EnvironmentalClearanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
