<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function getTitle(): string
    {
        return 'Mi perfil';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del usuario')
                    ->schema([
                        TextInput::make('id')
                            ->label('ID')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('name')
                            ->label('Nombre')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('role')
                            ->label('Rol')
                            ->disabled()
                            ->dehydrated(false),
                        $this->getEmailFormComponent()
                            ->label('Correo electrónico'),
                        TextInput::make('email_verified_at')
                            ->label('Correo verificado')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('created_at')
                            ->label('Creado')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('updated_at')
                            ->label('Última modificación')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
                Section::make('Contraseña')
                    ->schema([
                        $this->getPasswordFormComponent()
                            ->label('Nueva contraseña'),
                        $this->getPasswordConfirmationFormComponent()
                            ->label('Confirmar nueva contraseña'),
                    ]),
            ]);
    }
}
