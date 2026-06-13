<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizationService
{
    public function optimize(string $path, int $quality = 80, int $maxWidth = 800): void
    {
        $manager = new ImageManager(new Driver());
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) return;

        $image = $manager->read($fullPath);

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $image->toJpeg($quality)->save($fullPath);
    }
}