<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use Carbon\Carbon;

use App\Models\Product;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected function getCards(): array
    {
        $total_income = number_format(( Order::sum('price') + Order::sum('tax') ) / 100, 2, ',', ',');
        $today_income = number_format(
            ( 
                Order::whereDate('created_at', Carbon::today())->sum('price') + 
                Order::whereDate('created_at', Carbon::today())->sum('tax') 
            ) / 100, 2,
            ',', ',');
        return [
            Card::make('Income', "$" . $total_income)
            ->description('Today\'s Income $' . $today_income)
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),

            Card::make('Orders', Order::count())
            ->description(Order::whereDate('created_at', Carbon::today())->count() . ' new order added')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),

            Card::make('Products', Product::count())
            ->description(Product::where('discount', '>', 0)->count() . ' product in sale off')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),

            Card::make('Categories', Category::count())
            ->description(Category::whereDate('created_at', Carbon::today())->count() . ' new category added')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),

            Card::make('Posts', Post::count())
            ->description(Post::whereDate('created_at', Carbon::today())->count() . ' new post added')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),            

            Card::make('Users', User::count())
            ->description(User::whereDate('created_at', Carbon::today())->count() . ' new user added')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),
        ];
    }
}
