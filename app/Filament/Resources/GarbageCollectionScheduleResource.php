<?php

// app/Filament/Resources/GarbageCollectionScheduleResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\GarbageCollectionScheduleResource\Pages;
use App\Models\GarbageCollectionSchedule;
use App\Models\Barangay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GarbageCollectionScheduleResource extends Resource
{
    protected static ?string $model = GarbageCollectionSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Waste Management';

    protected static ?string $navigationLabel = 'Collection Schedules';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barangay_id')
                    ->label('Barangay')
                    ->options(Barangay::all()->pluck('name', 'barangay_id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('collection_date')
                    ->required(),
                Forms\Components\TimePicker::make('collection_time')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'missed' => 'Missed',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('schedule_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('barangay.name')
                    ->searchable()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('barangay_id')
                    ->label('Barangay')
                    ->options(Barangay::all()->pluck('name', 'barangay_id')),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'missed' => 'Missed',
                    ]),
                Tables\Filters\Filter::make('collection_date')
                    ->form([
                        Forms\Components\DatePicker::make('collection_from'),
                        Forms\Components\DatePicker::make('collection_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['collection_from'],
                                fn($query) => $query->whereDate('collection_date', '>=', $data['collection_from']),
                            )
                            ->when(
                                $data['collection_until'],
                                fn($query) => $query->whereDate('collection_date', '<=', $data['collection_until']),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('markCompleted')
                    ->label('Mark as Completed')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (GarbageCollectionSchedule $record): void {
                        $record->status = 'completed';
                        $record->save();
                    })
                    ->visible(fn(GarbageCollectionSchedule $record): bool => $record->status === 'pending'),
                Tables\Actions\Action::make('markMissed')
                    ->label('Mark as Missed')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(function (GarbageCollectionSchedule $record): void {
                        $record->status = 'missed';
                        $record->save();
                    })
                    ->visible(fn(GarbageCollectionSchedule $record): bool => $record->status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markCompleted')
                        ->label('Mark as Completed')
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->status = 'completed';
                                $record->save();
                            });
                        }),
                    Tables\Actions\BulkAction::make('markMissed')
                        ->label('Mark as Missed')
                        ->icon('heroicon-o-x-circle')
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->status = 'missed';
                                $record->save();
                            });
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGarbageCollectionSchedules::route('/'),
            'create' => Pages\CreateGarbageCollectionSchedule::route('/create'),
            'edit' => Pages\EditGarbageCollectionSchedule::route('/{record}/edit'),
        ];
    }
}
