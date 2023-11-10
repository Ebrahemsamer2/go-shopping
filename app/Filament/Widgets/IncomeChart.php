<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Order;
use Carbon\Carbon;

class IncomeChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '300px';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getHeading(): string
    {
        return 'Gross Monthly Income';
    }
 
    protected function getData(): array
    {
        $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $orders = Order::select('created_at')->get()->groupBy(function($order){
            return Carbon::parse($order->created_at)->format('m');
        });
        
        for($i = 1; $i <= 12; $i++)
        {
            if(isset($orders[$i])) {
                // get the amount of income in this month
                $month_income = ( Order::whereMonth('created_at', $i)->sum('price') + Order::whereMonth('created_at', $i)->sum('tax') ) / 100;
                $orders[$months[$i]] = $month_income;
                unset($orders[$i]);
            } else {
                $orders[$months[$i]] = 0;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Monthly Income',
                    'data' => $orders,
                ],
            ]
        ];
    }
}
