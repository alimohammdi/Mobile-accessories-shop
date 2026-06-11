<?php

namespace App\Filament\Resources\DescriptionTemplateResource\Pages;

use App\Filament\Resources\DescriptionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDescriptionTemplate extends CreateRecord
{
    protected static string $resource = DescriptionTemplateResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'توضیحات  با موفقیت ایجاد شد';
    }

    }