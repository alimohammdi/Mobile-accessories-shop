<?php
namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
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
                ->color('info')
                ->url(route('filament.admin.resources.customers.index')),

            Stat::make('کل محصولات', Product::count())
                ->description('تعداد کل محصولات')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary')
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('محصولات فعال', Product::where('is_active', true)->count())
                ->description('محصولات در دسترس')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('دسته‌بندی‌ها', Category::count())
                ->description('تعداد دسته‌بندی‌ها')
                ->descriptionIcon('heroicon-o-tag')
                ->color('warning')
                ->url(route('filament.admin.resources.categories.index')),

            Stat::make('برندها', Brand::count())
                ->description('تعداد برندها')
                ->descriptionIcon('heroicon-o-building-storefront')
                ->color('danger')
                ->url(route('filament.admin.resources.brands.index')),

            Stat::make('ادمین‌ها', User::count())
                ->description('تعداد ادمین‌ها')
                ->descriptionIcon('heroicon-o-user')
                ->color('info')
                ->url(route('filament.admin.resources.users.index')),

            Stat::make('موجودی کل', Product::sum('stock') . ' عدد')
                ->description('مجموع موجودی انبار')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('کل سفارشات', Order::count())
                ->description('تعداد کل سفارشات')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('success')
                ->url(route('filament.admin.resources.orders.index')),

            Stat::make('سفارشات امروز', Order::whereDate('created_at', today())->count())
                ->description('سفارشات ثبت شده امروز')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('warning')
                ->url(route('filament.admin.resources.orders.index')),

            Stat::make('فروش امروز', number_format(Order::whereDate('created_at', today())->sum('final_price')) . ' تومان')
                ->description('مبلغ فروش امروز')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success')
                ->url(route('filament.admin.resources.orders.index')),
        ];
    }
}
