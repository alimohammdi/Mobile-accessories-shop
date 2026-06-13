<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for SEO';

    public function handle()
    {
        $baseUrl = config('app.url');
        $urls = [];

        // صفحات ثابت
        $urls[] = ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'];
        $urls[] = ['loc' => $baseUrl . '/products', 'priority' => '0.9', 'changefreq' => 'daily'];
        $urls[] = ['loc' => $baseUrl . '/categories', 'priority' => '0.8', 'changefreq' => 'weekly'];

        // محصولات
        Product::where('is_active', true)
            ->whereNotNull('slug')
            ->each(function ($product) use ($baseUrl, &$urls) {
                $urls[] = [
                    'loc'        => $baseUrl . '/products/' . $product->slug,
                    'lastmod'    => $product->updated_at->toAtomString(),
                    'priority'   => '0.8',
                    'changefreq' => 'weekly',
                ];
            });

        // دسته‌بندی‌ها
        Category::whereNotNull('slug')
            ->each(function ($category) use ($baseUrl, &$urls) {
                $urls[] = [
                    'loc'        => $baseUrl . '/categories/' . $category->slug,
                    'lastmod'    => $category->updated_at->toAtomString(),
                    'priority'   => '0.7',
                    'changefreq' => 'weekly',
                ];
            });

        // ساخت XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . $url['loc'] . '</loc>' . PHP_EOL;
            if (isset($url['lastmod'])) {
                $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            }
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info('sitemap.xml با موفقیت ساخته شد!');
    }
}
