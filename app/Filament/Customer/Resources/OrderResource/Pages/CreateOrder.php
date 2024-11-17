<?php

namespace App\Filament\Customer\Resources\OrderResource\Pages;

use App\Filament\Customer\Resources\OrderResource;
use App\Models\Outlet;
use App\Models\Service;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Select outlet')
                    ->schema([
                        Select::make('outlet_id')
                            ->options(
                                Outlet::all()->pluck('name', 'id')
                            )
                            ->live()
                            ->native(false)
                            ->searchable()
                    ]),
                Step::make('Select Services')
                    ->schema([
                        Repeater::make('services')
                            ->schema([
                                Select::make('service_id')
                                    ->options(
                                        Service::all()->pluck('name', 'id')
                                    )
                                    ->live()
                                    ->native(false)
                                    ->live()
                                    ->searchable()
                            ])
                    ]),
            ])->columnSpanFull(),
            Section::make('Order Information')
                ->schema([
                    TextInput::make('total_price')
                        ->prefix('IDR')
                        ->default('0')
                ])
        ]);
    }
}
