<?php

namespace App\Filament\Admin\Resources\OutletResource\Pages;

use App\Filament\Admin\Resources\OutletResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditOutlet extends EditRecord
{
    protected static string $resource = OutletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Section::make('Outlet Information')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('address')
                        ->required(),
                    TextInput::make('phone')
                        ->numeric()
                        ->required(),
                    TextInput::make('maps')
                        ->required()
                        ->url(),
                ]),
        ]);
    }
}
