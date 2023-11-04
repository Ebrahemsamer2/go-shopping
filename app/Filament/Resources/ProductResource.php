<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;

use Closure;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Shop';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Grid::make(2)
                    ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255),
                    ]),
                Forms\Components\Textarea::make('small_description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(65535),
                
                    Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('price')->numeric()->minValue(1)->required(),
                        Forms\Components\TextInput::make('discount')->numeric()->minValue(0)->maxValue(100)->required(),
                        Forms\Components\TextInput::make('stock')->numeric()->minValue(0)->required(),
                    ]),
                Forms\Components\FileUpload::make('thumbnail')->directory('img/product')->required(),
                    Grid::make(2)
                    ->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name', fn (Builder $query) => $query->where('user_type', 'admin'))
                        ->required(),
                    Forms\Components\Select::make('category_id')->relationship('category', 'name')
                        ->required(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('small_description'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\TextColumn::make('stock'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }    
}
