<?php
namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('کاربران', Customer::count())
                ->description('تعداد کاربران ثبت نام شده')
                ->descriptionIcon('heroicon-o-users')
                ->color('info'),

            Stat::make('کل محصولات', Product::count())
                ->description('تعداد کل محصولات')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary'),

            Stat::make('محصولات فعال', Product::where('is_active', true)->count())
                ->description('محصولات در دسترس')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('دسته‌بندی‌ها', Category::count())
                ->description('تعداد دسته‌بندی‌ها')
                ->descriptionIcon('heroicon-o-tag')
                ->color('warning'),

            Stat::make('برندها', Brand::count())
                ->description('تعداد برندها')
                ->descriptionIcon('heroicon-o-building-storefront')
                ->color('danger'),

            Stat::make('ادمین ها ', User::count())
                ->description('تعداد ادمین ها   ')
                ->descriptionIcon('heroicon-o-user')
                ->color('info'),

            Stat::make('موجودی کل', Product::sum('stock') . ' عدد')
                ->description('مجموع موجودی انبار')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('primary'),
        ];
    }
}
