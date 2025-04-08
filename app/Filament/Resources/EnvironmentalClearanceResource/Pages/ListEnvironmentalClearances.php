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
            Actions\Action::make('downloadCertificate')
                ->label('Download Request Certificate')
                ->color('info')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(asset('files/malvar_clearance_request_certificate.pdf'))
                ->openUrlInNewTab(),
            Actions\CreateAction::make()->label('New Request'),
        ];
    }
}
