<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Section::make('User Information')->schema([
                FileUpload::make('avatar_url')
                    ->placeholder('Please upload image file')
                    ->columnSpanFull()
                    ->required()
                    ->image(),
                TextInput::make('name')
                    ->placeholder('Please input full name')
                    ->string()
                    ->required(),
                TextInput::make('email')
                    ->placeholder('Please input user email')
                    ->email()
                    ->required(),
            ]),
            Section::make('Credentials')
                ->schema([
                    TextInput::make('password')
                        ->placeholder('Please input password')
                        ->password()
                        ->required(),
                    TextInput::make('confirm_password')
                        ->placeholder('Please confirm password')
                        ->password()
                        ->required()
                        ->same('password'),
                ]),
        ]);
    }
}
