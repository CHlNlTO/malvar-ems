<?php

// app/Filament/Resources/EnvironmentalClearanceResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\EnvironmentalClearanceResource\Pages;
use App\Models\EnvironmentalClearance;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EnvironmentalClearanceResource extends Resource
{
    protected static ?string $model = EnvironmentalClearance::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Environment Management';

    protected static ?string $navigationLabel = 'Clearance Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->label('Company')
                    ->options(Company::all()->pluck('name', 'company_id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('submission_date')
                    ->default(now())
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('remarks')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('clearance_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('submission_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('company_id')
                    ->label('Company')
                    ->options(Company::all()->pluck('name', 'company_id')),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                Tables\Filters\Filter::make('submission_date')
                    ->form([
                        Forms\Components\DatePicker::make('submitted_from'),
                        Forms\Components\DatePicker::make('submitted_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['submitted_from'],
                                fn($query) => $query->whereDate('submission_date', '>=', $data['submitted_from']),
                            )
                            ->when(
                                $data['submitted_until'],
                                fn($query) => $query->whereDate('submission_date', '<=', $data['submitted_until']),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official'])),
                Tables\Actions\DeleteAction::make()->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official'])),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official']))
                    ->action(function (EnvironmentalClearance $record): void {
                        $record->status = 'approved';
                        $record->save();
                    })
                    ->visible(fn(EnvironmentalClearance $record): bool => $record->status === 'pending'),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official']))
                    ->action(function (EnvironmentalClearance $record, array $data): void {
                        $record->status = 'rejected';
                        if (isset($data['remarks'])) {
                            $record->remarks = $data['remarks'];
                        }
                        $record->save();
                    })
                    ->form([
                        Forms\Components\Textarea::make('remarks')
                            ->label('Reason for Rejection')
                            ->required(),
                    ])
                    ->visible(fn(EnvironmentalClearance $record): bool => $record->status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official'])),
                    Tables\Actions\BulkAction::make('approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'barangay_official']))
                        ->action(function ($records): void {
                            $records->each(function ($record): void {
                                $record->status = 'approved';
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
            'index' => Pages\ListEnvironmentalClearances::route('/'),
            'create' => Pages\CreateEnvironmentalClearance::route('/create'),
            'edit' => Pages\EditEnvironmentalClearance::route('/{record}/edit'),
        ];
    }
}
