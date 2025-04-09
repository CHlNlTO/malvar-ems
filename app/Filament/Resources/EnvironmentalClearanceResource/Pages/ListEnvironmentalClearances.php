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
            Actions\CreateAction::make()->label('New Request')->visible(function () {
                $user = auth()->user();

                // Allow admins and officials to always see the button
                if ($user->hasAnyRole(['super_admin', 'admin', 'barangay_official'])) {
                    return true;
                }

                // For company users, only show if they have a company_id
                if ($user->hasRole('company')) {
                    return $user->company_id !== null;
                }

                // Hide for all other users
                return false;
            }),
        ];
    }
}
