<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialRecyclingFacilityResource\Pages;
use App\Models\MaterialRecyclingFacility;
use App\Models\Barangay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MaterialRecyclingFacilityResource extends Resource
{
    protected static ?string $model = MaterialRecyclingFacility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Waste Management';

    protected static ?string $navigationLabel = 'Material Recycling Facilities';

    protected static ?string $modelLabel = 'MRF';

    protected static ?string $pluralModelLabel = 'MRFs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('barangay_id')
                    ->label('Barangay')
                    ->options(Barangay::all()->pluck('name', 'barangay_id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('capacity')
                    ->label('Daily Capacity (kg)')
                    ->numeric()
                    ->required()
                    ->helperText('Maximum daily waste processing capacity in kilograms'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'maintenance' => 'Under Maintenance',
                    ])
                    ->default('active')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mrf_id')
                    ->label('MRF ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('barangay.name')
                    ->label('Barangay')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacity (kg)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'maintenance' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('utilization_percentage')
                    ->label('Today\'s Utilization')
                    ->formatStateUsing(fn($state) => number_format($state, 1) . '%')
                    ->color(fn($state) => $state > 80 ? 'danger' : ($state > 60 ? 'warning' : 'success')),
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
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'maintenance' => 'Under Maintenance',
                    ]),
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
            'index' => Pages\ListMaterialRecyclingFacilities::route('/'),
            'create' => Pages\CreateMaterialRecyclingFacility::route('/create'),
            'edit' => Pages\EditMaterialRecyclingFacility::route('/{record}/edit'),
        ];
    }
}
