<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('سفارش جدید'),
        ];
    }

   public function getTabs(): array
{
    return [
        'all' => Tab::make('همه'),
        'trashed' => Tab::make('آرشیو شده')
            ->modifyQueryUsing(fn(Builder $query) => $query->onlyTrashed()),
    ];
}
}
