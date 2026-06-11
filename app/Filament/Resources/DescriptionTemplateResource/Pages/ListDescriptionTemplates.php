<?php

namespace App\Filament\Resources\DescriptionTemplateResource\Pages;

use App\Filament\Resources\DescriptionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDescriptionTemplates extends ListRecords
{
    protected static string $resource = DescriptionTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
