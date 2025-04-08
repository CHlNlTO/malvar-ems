<?php

namespace App\Filament\Pages\Auth;

use App\Models\Company;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getRoleFormComponent(),
                $this->getCompanyFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->label('Role')
            ->options(function () {
                // Exclude super_admin and admin roles
                return Role::whereNotIn('name', ['super_admin', 'admin'])
                    ->pluck('name', 'name');
            })
            ->required()
            ->reactive();
    }

    protected function getCompanyFormComponent(): Component
    {
        return Select::make('company_id')
            ->label('Company')
            ->options(Company::pluck('name', 'company_id'))
            ->searchable()
            ->required(fn($get) => $get('role') === 'company')
            ->visible(fn($get) => $get('role') === 'company');
    }

    public function register(): \Filament\Http\Responses\Auth\Contracts\RegistrationResponse|null
    {
        $this->validate();

        $data = $this->form->getState();
        $role = $data['role'];
        unset($data['role']);

        // Begin transaction to ensure both user creation and role assignment succeed
        DB::beginTransaction();
        try {
            $user = $this->getUserModel()::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'company_id' => $data['company_id'] ?? null,
                'is_approved' => false, // Require approval
            ]);

            // Assign role
            $user->assignRole($role);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        // Show success notification using Filament's notification system
        Notification::make()
            ->success()
            ->title('Registration successful')
            ->body('Your account has been created. An administrator will approve it shortly.')
            ->send();

        return null;
    }
}
