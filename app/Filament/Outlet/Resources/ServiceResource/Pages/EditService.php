<?php

namespace App\Filament\Outlet\Resources\ServiceResource\Pages;

use App\Filament\Outlet\Resources\ServiceResource;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Section::make('Services Information')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('price')
                        ->prefix('IDR')
                        ->numeric(),
                    Select::make('pricing_type')
                        ->options([
                            'per_item' => 'Per Item',
                            'per_kilogram' => 'Per Kilogram',
                        ])
                        ->native(false),
                ])->columnSpanFull(),
            Section::make('Description')
                ->schema([
                    RichEditor::make('description'),
                ]),
        ]);
    }
}
