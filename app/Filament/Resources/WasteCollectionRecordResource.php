<?php

// app/Filament/Resources/WasteCollectionRecordResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\WasteCollectionRecordResource\Pages;
use App\Models\WasteCollectionRecord;
use App\Models\GarbageCollectionSchedule;
use App\Models\MaterialRecyclingFacility;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WasteCollectionRecordResource extends Resource
{
    protected static ?string $model = WasteCollectionRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Waste Management';

    protected static ?string $navigationLabel = 'Collection Records';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('schedule_id')
                    ->label('Collection Schedule')
                    ->options(function () {
                        return GarbageCollectionSchedule::with('barangay')
                            ->get()
                            ->mapWithKeys(function ($schedule) {
                                $barangayName = $schedule->barangay->name;
                                $date = $schedule->collection_date->format('M d, Y');
                                $time = $schedule->collection_time->format('h:i A');
                                return [$schedule->schedule_id => "{$barangayName} - {$date} {$time}"];
                            });
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('biodegradable_volume')
                    ->label('Biodegradable Waste (kg)')
                    ->numeric()
                    ->required()
                    ->live() // Make it live to react to changes
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $set(
                            'total_volume',
                            (float) $get('biodegradable_volume') +
                                (float) $get('non_biodegradable_volume') +
                                (float) $get('hazardous_volume')
                        );
                    }),
                Forms\Components\TextInput::make('non_biodegradable_volume')
                    ->label('Non-Biodegradable Waste (kg)')
                    ->numeric()
                    ->required()
                    ->live() // Make it live to react to changes
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $set(
                            'total_volume',
                            (float) $get('biodegradable_volume') +
                                (float) $get('non_biodegradable_volume') +
                                (float) $get('hazardous_volume')
                        );
                    }),
                Forms\Components\TextInput::make('hazardous_volume')
                    ->label('Hazardous Waste (kg)')
                    ->numeric()
                    ->required()
                    ->live() // Make it live to react to changes
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $set(
                            'total_volume',
                            (float) $get('biodegradable_volume') +
                                (float) $get('non_biodegradable_volume') +
                                (float) $get('hazardous_volume')
                        );
                    }),
                Forms\Components\TextInput::make('total_volume')
                    ->label('Total Volume (kg)')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\Select::make('collector_id')
                    ->label('Collector')
                    ->options(function () {
                        // This uses Spatie Permission's role() scope to find users with the collector role
                        return User::role('waste_collector')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('mrf_id')
                    ->label('Material Recycling Facility')
                    ->options(function () {
                        return MaterialRecyclingFacility::with('barangay')
                            ->where('status', 'active')
                            ->get()
                            ->mapWithKeys(function ($mrf) {
                                return [$mrf->mrf_id => "{$mrf->name} ({$mrf->barangay->name})"];
                            });
                    })
                    ->searchable()
                    ->nullable()
                    ->helperText('Select the MRF where waste will be processed'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('record_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule.barangay.name')
                    ->label('Barangay')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule.collection_date')
                    ->label('Collection Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('biodegradable_volume')
                    ->label('Biodegradable (kg)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('non_biodegradable_volume')
                    ->label('Non-Biodegradable (kg)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hazardous_volume')
                    ->label('Hazardous (kg)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_volume')
                    ->label('Total (kg)')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total'),
                    ]),
                Tables\Columns\TextColumn::make('collector.name')
                    ->label('Collector')
                    ->searchable(),
                Tables\Columns\TextColumn::make('materialRecyclingFacility.name')
                    ->label('MRF')
                    ->searchable()
                    ->placeholder('Not assigned'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('schedule.barangay_id')
                    ->label('Barangay')
                    ->relationship('schedule.barangay', 'name'),
                Tables\Filters\Filter::make('collection_date')
                    ->form([
                        Forms\Components\DatePicker::make('collected_from'),
                        Forms\Components\DatePicker::make('collected_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['collected_from'],
                                fn($query) => $query->whereHas(
                                    'schedule',
                                    fn($q) =>
                                    $q->whereDate('collection_date', '>=', $data['collected_from'])
                                ),
                            )
                            ->when(
                                $data['collected_until'],
                                fn($query) => $query->whereHas(
                                    'schedule',
                                    fn($q) =>
                                    $q->whereDate('collection_date', '<=', $data['collected_until'])
                                ),
                            );
                    }),
                Tables\Filters\SelectFilter::make('collector_id')
                    ->relationship('collector', 'name')
                    ->label('Collector'),
                Tables\Filters\SelectFilter::make('mrf_id')
                    ->relationship('materialRecyclingFacility', 'name')
                    ->label('MRF'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListWasteCollectionRecords::route('/'),
            'create' => Pages\CreateWasteCollectionRecord::route('/create'),
            'edit' => Pages\EditWasteCollectionRecord::route('/{record}/edit'),
        ];
    }
}
