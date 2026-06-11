<?php

namespace App\Filament\Resources\DescriptionTemplateResource\Pages;

use App\Filament\Resources\DescriptionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDescriptionTemplate extends EditRecord
{
    protected static string $resource = DescriptionTemplateResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'توضیحات  با موفقیت ویرایش شد';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('حذف'),
        ];
    }
}