<?php

namespace App\Filament\Resources\EnvironmentalClearanceResource\Pages;

use App\Filament\Resources\EnvironmentalClearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewEnvironmentalClearance extends ViewRecord
{
    protected static string $resource = EnvironmentalClearanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('clearance_id')
                    ->label('Clearance ID'),
                Infolists\Components\TextEntry::make('company.name')
                    ->label('Company'),
                Infolists\Components\TextEntry::make('submission_date')
                    ->date(),
                Infolists\Components\TextEntry::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                    }),
                Infolists\Components\TextEntry::make('remarks')
                    ->columnSpanFull(),
                Infolists\Components\TextEntry::make('document')
                    ->label('Supporting Document')
                    ->columnSpanFull()
                    ->visible(fn($state) => filled($state))
                    ->url(fn($state) => $state ? asset('storage/' . $state) : null)
                    ->openUrlInNewTab()
            ]);
    }
}
