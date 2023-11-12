<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;

class LatestPosts extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $pollingInterval = null;

    protected function getTableQuery(): Builder
    {
        return Post::query()->latest();
    }
 
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\ImageColumn::make('thumbnail'),
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\TextColumn::make('blogCategory.name'),
            Tables\Columns\TextColumn::make('author.name'),
        ];
    }
}
