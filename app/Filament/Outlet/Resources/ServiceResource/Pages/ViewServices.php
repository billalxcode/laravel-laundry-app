<?php

namespace App\Filament\Outlet\Resources\ServiceResource\Pages;

use App\Filament\Outlet\Resources\ServiceResource;
use Filament\Resources\Pages\ViewRecord;

class ViewServices extends ViewRecord
{
    protected static string $resource = ServiceResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist->schema([

        ]);
    }
}
