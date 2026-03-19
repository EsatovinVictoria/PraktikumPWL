<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                TextInput::make('email')
                ->required()
                ->email()
                ->unique()
                ->maxLength(255),

                TextInput::make('password')
                ->password()
                ->required()
                ->minLength(6),
            ]);
    }
}
