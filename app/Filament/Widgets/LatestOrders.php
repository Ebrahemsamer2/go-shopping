<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $pollingInterval = null;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Order::query()->latest();
    }
 
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('country'),
            Tables\Columns\TextColumn::make('price')
            ->formatStateUsing(fn (string $state): string => number_format($state / 100, 2, ',', ',')),
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('payment_method'),
        ];
    }
}
