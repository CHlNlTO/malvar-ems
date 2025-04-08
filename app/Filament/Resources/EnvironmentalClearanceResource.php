<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnvironmentalClearanceResource\Pages;
use App\Models\EnvironmentalClearance;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EnvironmentalClearanceResource extends Resource
{
    protected static ?string $model = EnvironmentalClearance::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Environment Management';

    protected static ?string $navigationLabel = 'Clearance Requests';

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $isCompanyRep = $user?->hasRole('company');

        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->label('Company')
                    ->options(function () use ($user, $isCompanyRep) {
                        if ($isCompanyRep) {
                            // Only show user's company
                            return Company::where('company_id', $user->company_id)
                                ->pluck('name', 'company_id');
                        }
                        // Show all companies for other roles
                        return Company::pluck('name', 'company_id');
                    })
                    ->searchable()
                    ->required()
                    ->disabled($isCompanyRep) // Disable for company reps
                    ->dehydrated(true) // Still include in submitted data even if disabled
                    ->default(function () use ($user, $isCompanyRep) {
                        // Default to user's company if they're a company rep
                        if ($isCompanyRep && $user->company_id) {
                            return $user->company_id;
                        }
                        return null;
                    }),
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
                    ->disabled($isCompanyRep) // Disable status field for company reps
                    ->dehydrated(true) // Ensure it's still included in form submission
                    ->required(),
                Forms\Components\FileUpload::make('document')
                    ->label('Supporting Document (PDF)')
                    ->directory('clearance-documents')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(5120) // 5MB in kilobytes
                    ->helperText('Upload PDF file (max 5MB)'),
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
                Tables\Columns\TextColumn::make('document')
                    ->label('Document')
                    ->formatStateUsing(fn($state) => $state ? 'Uploaded' : 'Not Uploaded')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('remarks')
                    ->searchable()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])),
                Tables\Actions\DeleteAction::make()->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(function (EnvironmentalClearance $record) {
                        return auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])
                            && $record->status === 'pending';
                    })
                    ->action(function (EnvironmentalClearance $record): void {
                        $record->status = 'approved';
                        $record->save();
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(function (EnvironmentalClearance $record) {
                        return auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])
                            && $record->status === 'pending';
                    })
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
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'admin', 'barangay_official'])),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Add role-based query scoping
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        // Check if user has admin/official roles that should see all records
        $hasFullAccess = $user?->hasAnyRole(['super_admin', 'admin', 'barangay_official']);

        // If user does NOT have full access roles, restrict to their company's records
        if (!$hasFullAccess && $user && $user->company_id) {
            $query->where('company_id', $user->company_id);
        }

        return $query;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnvironmentalClearances::route('/'),
            'create' => Pages\CreateEnvironmentalClearance::route('/create'),
            'view' => Pages\ViewEnvironmentalClearance::route('/{record}'),
            'edit' => Pages\EditEnvironmentalClearance::route('/{record}/edit'),
        ];
    }
}
