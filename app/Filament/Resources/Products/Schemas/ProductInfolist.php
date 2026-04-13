<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make("Product Tabs")
                ->tabs([
                    Tab::make("Product Details")
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Name')
                                ->weight('bold')
                                ->color('primary'),
                            TextEntry::make('id')
                                ->label('Product ID'),
                            TextEntry::make('sku')
                                ->label('SKU')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('description')
                                ->label('Product Description'),
                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y')
                                ->color('info'),
                        ]),
                    Tab::make("Product price and Stock")
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-currency-dollar'),
                            TextEntry::make('stock')
                                ->label('Product Stock')
                                ->icon('heroicon-o-archive-box')
                                ->badge()
                                ->formatStateUsing(fn ($state) => $state > 0 ? 'Ada' : 'Habis')
                                ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),
                        ]),
                    Tab::make("Image and Status")
                        ->icon('heroicon-o-photo')
                        ->schema([
                            ImageEntry::make('image')
                                ->label('Product Image')
                                ->disk('public'),
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-currency-dollar'),
                            TextEntry::make('stock')
                                ->label('Product Stock')
                                ->weight('bold')
                                ->color('primary'),
                            IconEntry::make('is_active')
                                ->label('Is Active?')
                                ->boolean(),
                            IconEntry::make('is_featured')
                                ->label('Is Featured?')
                                ->boolean()
                        ]),
                ])
                ->columnSpanFull()
                ->vertical(),

                Section::make("Product Info")
                    ->description("")
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('SKU')
                            ->badge()
                            ->color('warning'),
                        TextEntry::make('description')
                            ->label('Product Description'),
                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                ->columnSpanFull(),

                Section::make("Product price and Stock")
                    ->description("")
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-o-archive-box'),
                    ])
                ->columnSpanFull(),

                Section::make("Image and Status")
                    ->description("")
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary'),
                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean()
                            
                    ])
                ->columnSpanFull(),
            ]);
    }
}
