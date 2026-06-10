<?php
namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'نمودار سفارشات هفته اخیر';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn($i) => Carbon::today()->subDays($i));

        $orders = $days->map(fn($day) => Order::whereDate('created_at', $day)->count());
        $amounts = $days->map(fn($day) => Order::whereDate('created_at', $day)->sum('final_price'));
        $labels = $days->map(fn($day) => $day->format('m/d'));

        return [
            'datasets' => [
                [
                    'label' => 'تعداد سفارشات',
                    'data' => $orders->values()->toArray(),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'مبلغ کل (تومان)',
                    'data' => $amounts->values()->toArray(),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'position' => 'left',
                    'title' => ['display' => true, 'text' => 'تعداد'],
                ],
                'y1' => [
                    'type' => 'linear',
                    'position' => 'right',
                    'title' => ['display' => true, 'text' => 'مبلغ'],
                    'grid' => ['drawOnChartArea' => false],
                ],
            ],
        ];
    }
}
