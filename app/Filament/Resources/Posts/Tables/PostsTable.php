<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Schemas\Components\Image;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Symfony\Component\Console\Color;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("slug")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("category.name")
                    ->sortable()
                    ->searchable(),
                ColorColumn::make("color"),
                IconColumn::make("published")
                    ->boolean(),
                ImageColumn::make("image")
                    ->disk("public"),
                TextColumn::make("created_at")
                    ->label("Created At")
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort("created_at", "desc")
            ->filters([
                Filter::make("created_at")
                    ->label("Creation Date")
                    ->schema([
                        DatePicker::make("created_at")
                            ->label("Select Date : "),
                    ])
                    ->query(function ($query, $data) {
                        return $query
                            ->when(
                                $data["created_at"],
                                fn ($query, $date) => $query->whereDate("created_at", $date)
                            );
                    }),
                SelectFilter::make("category_id")
                    ->label("Category")
                    ->relationship("category", "name")
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
