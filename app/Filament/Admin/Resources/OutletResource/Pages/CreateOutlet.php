<?php

namespace App\Filament\Admin\Resources\OutletResource\Pages;

use App\Filament\Admin\Resources\OutletResource;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateOutlet extends CreateRecord
{
    protected static string $resource = OutletResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::factory()->create([
            'avatar_url' => $data['user']['avatar_url'],
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => $data['user']['password'],
        ]);
        $user->assignRole('outlet');

        $outlet = $user->outlet()->create([
            'name' => $data['outlet']['name'],
            'address' => $data['outlet']['address'],
            'phone' => $data['outlet']['phone'],
            'maps' => $data['outlet']['maps'],
        ]);

        return $outlet;
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Create new user')
                    ->schema([
                        Section::make('User Information')->schema([
                            FileUpload::make('user.avatar_url')
                                ->placeholder('Please upload image file')
                                ->columnSpanFull()
                                ->required()
                                ->image()
                                ->live(),
                            TextInput::make('user.name')
                                ->placeholder('Please input full name')
                                ->string()
                                ->required(),
                            TextInput::make('user.email')
                                ->placeholder('Please input user email')
                                ->email()
                                ->unique(User::class, 'email')
                                ->required(),
                        ]),
                        Section::make('Credentials')
                            ->schema([
                                TextInput::make('user.password')
                                    ->placeholder('Please input password')
                                    ->password()
                                    ->revealable()
                                    ->required(),
                                TextInput::make('confirm_password')
                                    ->placeholder('Please confirm password')
                                    ->password()
                                    ->revealable()
                                    ->required()
                                    ->same('user.password'),
                            ]),
                    ]),
                Step::make('Register new outlet')
                    ->schema([
                        Section::make('Outlet Information')
                            ->schema([
                                TextInput::make('outlet.name')
                                    ->required(),
                                TextInput::make('outlet.address')
                                    ->required(),
                                TextInput::make('outlet.phone')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('outlet.maps')
                                    ->required()
                                    ->url(),
                            ]),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
