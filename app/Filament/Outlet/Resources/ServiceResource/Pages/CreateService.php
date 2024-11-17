<?php

namespace App\Filament\Outlet\Resources\ServiceResource\Pages;

use App\Filament\Outlet\Resources\ServiceResource;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $outlet = Auth::user()->outlet;

        $data['outlet_id'] = $outlet->id;

        return $data;
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
                        ->native(false)
                        ->default('per_item'),
                ])->columnSpanFull(),
            Section::make('Description')
                ->schema([
                    RichEditor::make('description'),
                ]),
        ]);
    }
}
