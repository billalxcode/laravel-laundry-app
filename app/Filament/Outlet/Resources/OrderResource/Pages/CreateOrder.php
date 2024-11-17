<?php

namespace App\Filament\Outlet\Resources\OrderResource\Pages;

use App\Filament\Outlet\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
