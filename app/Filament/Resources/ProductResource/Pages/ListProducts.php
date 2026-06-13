<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('محصول جدید'),
        ];
    }

public function getTabs(): array
{
    return [
        'all' => Tab::make('همه')
            ->query(fn(Builder $query) => $query->withoutTrashed()),
        'trashed' => Tab::make('آرشیو شده')
            ->query(fn(Builder $query) => $query->onlyTrashed()),
    ];
}
}
