<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class LatestProducts extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $pollingInterval = null;

    protected function getTableQuery(): Builder
    {
        return Product::query()->latest();
    }
 
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\ImageColumn::make('thumbnail'),
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\TextColumn::make('price')
            ->formatStateUsing(fn (string $state): string => number_format($state / 100, 2, ',', ',')),
            Tables\Columns\TextColumn::make('category.name'),
            Tables\Columns\TextColumn::make('user.name'),
        ];
    }
}
