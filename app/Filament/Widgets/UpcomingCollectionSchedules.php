<?php

// app/Filament/Widgets/UpcomingCollectionSchedules.php

namespace App\Filament\Widgets;

use App\Models\GarbageCollectionSchedule;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Carbon;

class UpcomingCollectionSchedules extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                GarbageCollectionSchedule::query()
                    ->with('barangay')
                    ->where('collection_date', '>=', Carbon::today())
                    ->where('status', 'pending')
                    ->orderBy('collection_date')
                    ->orderBy('collection_time')
                    ->limit(10)
            )
            ->heading('Upcoming Collection Schedules')
            ->columns([
                Tables\Columns\TextColumn::make('barangay.name')
                    ->label('Barangay')
                    ->searchable(),
                Tables\Columns\TextColumn::make('collection_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('collection_time')
                    ->time()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'missed' => 'danger',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('markCompleted')
                    ->label('Mark Completed')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->url(
                        fn(GarbageCollectionSchedule $record): string =>
                        route('filament.admin.resources.garbage-collection-schedules.edit', ['record' => $record])
                    )
            ]);
    }
}
