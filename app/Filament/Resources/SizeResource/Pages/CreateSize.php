<?php
namespace App\Filament\Resources\SizeResource\Pages;

use App\Filament\Resources\SizeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSize extends CreateRecord
{
    protected static string $resource = SizeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'شماره / سایز با موفقیت ایجاد شد';
    }
}
