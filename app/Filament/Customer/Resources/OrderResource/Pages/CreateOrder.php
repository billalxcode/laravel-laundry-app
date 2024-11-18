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
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                            ->label('Outlet')
                            ->options(
                                Outlet::all()->pluck('name', 'id')
                            )
                            ->live()
                            ->native(false)
                            ->searchable(),
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
                                    ->searchable()
                                    ->dehydrated()
                                    ->reactive()
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $service = Service::find($state);
                                        $set('pricing_type', $service->pricing_type);
                                        $set('price', $service->price);
                                    }),
                                TextInput::make('price')
                                    ->readOnly()
                                    ->prefix('IDR')
                                    ->default($this->price ?? 0),
                                TextInput::make('weight')
                                    ->numeric()
                                    ->suffix('KG')
                                    ->hidden(fn(Get $get) => $get('pricing_type') !== 'per_kilogram'),
                            ])
                            ->live()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $selectedServices = collect($get('services'))
                                    ->filter(fn ($item) => !empty($item['service_id'] && (!empty($item['weight'] || !empty($item['qty'])))));
                                $services = Service::find(
                                    $selectedServices->pluck('service_id')
                                )->pluck('price', 'id');
                                $total_price = $selectedServices->reduce(function ($total_price, $service) use ($services) {
                                    if ($service['weight']) {
                                        return $total_price + ($services[$service['service_id']] * $service['weight']);
                                    }
                                });
                                $set('total_price', $total_price);
                            }),
                    ]),
            ])->columnSpanFull(),

            Section::make('Order Information')
                ->schema([
                    TextInput::make('total_price')
                        ->prefix('IDR')
                        ->readOnly()
                        ->default($this->total_price ?? '0'),
                ]),
        ]);
    }
}
